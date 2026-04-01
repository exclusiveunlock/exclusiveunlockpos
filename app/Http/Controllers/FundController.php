<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Models\FundLog;
use App\Models\PaymentGateway;
use App\Models\PaymentGatewayLog;
use App\Models\User;

class FundController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | USER — Wallet index
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $user = Auth::user();

        $logs = FundLog::where('user_id', $user->id)
            ->latest()
            ->paginate(20);

        return view('funds.index', compact('user', 'logs'));
    }

    /*
    |--------------------------------------------------------------------------
    | USER — Show add-funds form
    |--------------------------------------------------------------------------
    */
    public function create(Request $request)
    {
        $paymentGateways = PaymentGateway::where('is_active', true)->get();
        $prefillAmount   = $request->query('amount');

        return view('funds.add', compact('paymentGateways', 'prefillAmount'));
    }

    /*
    |--------------------------------------------------------------------------
    | USER — Process add-funds  (POST /funds/add)
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'amount'             => 'required|numeric|min:1',
            'payment_gateway_id' => 'required|exists:payment_gateways,id',
        ]);

        $gateway = PaymentGateway::findOrFail($request->payment_gateway_id);
        $amount  = (float) $request->amount;
        $user    = Auth::user();

        // Log del intento
        PaymentGatewayLog::create([
            'payment_gateway_id' => $gateway->id,
            'user_id'            => $user->id,
            'event_type'         => 'fund_add_process',
            'request_data'       => json_encode($request->except('_token')),
            'response_data'      => json_encode(['message' => 'Processing...']),
            'status'             => 'pending',
        ]);

        /*
         * Tu BD tiene:
         *   id=1  slug="offline-payment"  type="manual"
         *   id=2  slug="gmx"              type="piprapay"
         *
         * El match usa el TYPE para que nuevos gateways con
         * el mismo type funcionen automáticamente.
         */
        return match ($gateway->type) {
            'piprapay' => $this->handlePipraPay($gateway, $amount, $user),
            'gsmpay'   => $this->handleGsmPay($gateway, $amount, $user),
            'manual'   => $this->handleManualGateway($gateway, $amount, $user),
            default    => $this->gatewayNotImplemented($gateway, $amount, $user),
        };
    }

    /*
    |--------------------------------------------------------------------------
    | USER — Historial de transacciones
    |--------------------------------------------------------------------------
    */
    public function history()
    {
        $logs = FundLog::where('user_id', Auth::id())
            ->latest()
            ->paginate(30);

        return view('funds.history', compact('logs'));
    }

    /*
    |--------------------------------------------------------------------------
    | USER — Payment callback GET
    |--------------------------------------------------------------------------
    */
    public function callback(Request $request, string $gateway)
    {
        return $this->processCallback($request, $gateway);
    }

    /*
    |--------------------------------------------------------------------------
    | USER — Payment callback POST (webhook)
    |--------------------------------------------------------------------------
    */
    public function callbackPost(Request $request, string $gateway)
    {
        return $this->processCallback($request, $gateway);
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN — Listar todos los fund logs
    |--------------------------------------------------------------------------
    */
    public function adminIndex()
    {
        $logs = FundLog::with('user', 'paymentGateway')
            ->latest()
            ->paginate(30);

        return view('admin.funds.index', compact('logs'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN — Agregar fondos manualmente
    |--------------------------------------------------------------------------
    */
    public function manual(Request $request)
    {
        $request->validate([
            'user_id'     => 'required|exists:users,id',
            'amount'      => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:255',
        ]);

        $user   = User::findOrFail($request->user_id);
        $amount = (float) $request->amount;

        $this->creditUser($user, $amount, null, $request->description ?? 'Manual credit by admin');

        return back()->with('success', "Added \${$amount} to {$user->name}'s account.");
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN — Eliminar un fund log
    |--------------------------------------------------------------------------
    */
    public function adminDestroy(int $id)
    {
        FundLog::findOrFail($id)->delete();

        return back()->with('success', 'Fund log deleted.');
    }

    /*
    |--------------------------------------------------------------------------
    | PRIVATE — Leer credenciales del gateway de forma segura
    |
    | El campo `credentials` puede ser:
    |   - NULL  (ej: offline-payment → no tiene credenciales)
    |   - string JSON  (cuando NO hay cast en el modelo)
    |   - array  (cuando el modelo tiene $casts = ['credentials' => 'array'])
    |--------------------------------------------------------------------------
    */
    private function getCredentials(PaymentGateway $gateway): array
    {
        $raw = $gateway->credentials;

        if (is_array($raw)) {
            return $raw;
        }

        if (is_string($raw) && $raw !== '') {
            return json_decode($raw, true) ?? [];
        }

        return [];
    }

    /*
    |--------------------------------------------------------------------------
    | PRIVATE — Acreditar al usuario y crear FundLog
    |--------------------------------------------------------------------------
    */
    private function creditUser(User $user, float $amount, ?int $gatewayId = null, string $description = 'Funds added'): void
    {
        $user->increment('balance', $amount);
        $user->increment('total_credit', $amount);

        FundLog::create([
            'user_id'            => $user->id,
            'amount'             => $amount,
            'type'               => 'credit',
            'payment_gateway_id' => $gatewayId,
            'description'        => $description,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | PRIVATE — Actualizar el último PaymentGatewayLog pendiente del usuario
    |--------------------------------------------------------------------------
    */
    private function updatePendingLog(User $user, array $data): void
    {
        PaymentGatewayLog::where('user_id', $user->id)
            ->where('status', 'pending')
            ->latest()
            ->first()
            ?->update($data);
    }

    /*
    |--------------------------------------------------------------------------
    | PRIVATE — Handlers de gateway
    |--------------------------------------------------------------------------
    */

    /**
     * PipraPay  (tu gateway "gmx" con type="piprapay")
     *
     * Credenciales en BD (campo `credentials` JSON):
     * {
     *   "piprapay_api_key":        "5818492268d9...",
     *   "piprapay_base_url":       "https://pay.gsmxtool.com",
     *   "piprapay_currency_option": "user_currency"   ← opcional
     * }
     *
     * Endpoint: POST {base_url}/api/create-checkout
     *
     * Respuesta esperada:
     * { "status": "success", "checkoutID": "...", "checkoutUrl": "https://..." }
     */
    private function handlePipraPay(PaymentGateway $gateway, float $amount, User $user)
    {
        $credentials = $this->getCredentials($gateway);

        $apiKey  = $credentials['piprapay_api_key']  ?? null;
        $baseUrl = rtrim($credentials['piprapay_base_url'] ?? 'https://pay.gsmxtool.com', '/');

        if (! $apiKey) {
            return back()->with('error', 'El gateway de pago no está configurado correctamente (falta api_key).');
        }

        $reference = 'FUND-' . $user->id . '-' . time();

        $payload = [
            'api_key'        => $apiKey,
            'amount'         => $amount,
            'product_name'   => 'Agregar fondos a la cuenta',
            'customer_name'  => $user->name,
            'customer_email' => $user->email,
            'webhook_url'    => route('funds.callback.post', ['gateway' => $gateway->slug]),
            'success_url'    => route('funds.callback',      ['gateway' => $gateway->slug]),
            'cancel_url'     => route('funds.index'),
            'failed_url'     => route('funds.index'),
            'invoice_id'     => $reference,
        ];

        // Enviar moneda si el gateway lo requiere
        if (! empty($credentials['piprapay_currency_option'])) {
            $payload['currency'] = strtoupper($user->currency?->code ?? 'USD');
        }

        $response = Http::timeout(30)->post($baseUrl . '/api/create-checkout', $payload);

        if (! $response->successful()) {
            Log::error('PipraPay HTTP error', [
                'status'  => $response->status(),
                'body'    => $response->body(),
                'user_id' => $user->id,
            ]);

            $this->updatePendingLog($user, [
                'response_data' => json_encode(['error' => 'HTTP ' . $response->status()]),
                'status'        => 'failed',
            ]);

            return back()->with('error', 'No se pudo conectar con el gateway de pago. Intenta de nuevo.');
        }

        $data = $response->json();

        if (
            ! isset($data['status'], $data['checkoutID'], $data['checkoutUrl']) ||
            $data['status'] !== 'success'
        ) {
            Log::error('PipraPay respuesta inválida', ['data' => $data, 'user_id' => $user->id]);

            $this->updatePendingLog($user, [
                'response_data' => json_encode($data),
                'status'        => 'failed',
            ]);

            return back()->with('error', $data['message'] ?? 'Error al crear el pago. Intenta de nuevo.');
        }

        // Guardar en cache: PipraPay NO devuelve el monto en el callback
        Cache::put('piprapay_checkout_' . $data['checkoutID'], [
            'user_id'    => $user->id,
            'amount'     => $amount,
            'reference'  => $reference,
            'gateway_id' => $gateway->id,
        ], now()->addHours(2));

        $this->updatePendingLog($user, [
            'response_data' => json_encode([
                'checkoutID'  => $data['checkoutID'],
                'checkoutUrl' => $data['checkoutUrl'],
                'reference'   => $reference,
            ]),
            'status' => 'redirected',
        ]);

        return redirect()->to($data['checkoutUrl']);
    }

    /**
     * GsmPay  (para gateways con type="gsmpay")
     *
     * Credenciales en BD:
     * {
     *   "gsmpay_api_key":    "...",
     *   "gsmpay_api_secret": "..."
     * }
     */
    private function handleGsmPay(PaymentGateway $gateway, float $amount, User $user)
    {
        $credentials = $this->getCredentials($gateway);

        $apiKey    = $credentials['gsmpay_api_key']    ?? null;
        $apiSecret = $credentials['gsmpay_api_secret'] ?? null;

        if (! $apiKey || ! $apiSecret) {
            return back()->with('error', 'El gateway GsmPay no está configurado correctamente.');
        }

        $reference = 'FUND-' . $user->id . '-' . time();

        $response = Http::timeout(30)->post('https://gsmpay.io/api/create-checkout', [
            'api_key'        => $apiKey,
            'api_secret'     => $apiSecret,
            'amount'         => $amount,
            'product_name'   => 'Agregar fondos a la cuenta',
            'customer_name'  => $user->name,
            'customer_email' => $user->email,
            'webhook_url'    => route('funds.callback.post', ['gateway' => $gateway->slug]),
            'success_url'    => route('funds.callback',      ['gateway' => $gateway->slug]),
            'cancel_url'     => route('funds.index'),
            'failed_url'     => route('funds.index'),
            'invoice_id'     => $reference,
        ]);

        if (! $response->successful()) {
            Log::error('GsmPay HTTP error', ['status' => $response->status(), 'user_id' => $user->id]);

            $this->updatePendingLog($user, [
                'response_data' => json_encode(['error' => 'HTTP ' . $response->status()]),
                'status'        => 'failed',
            ]);

            return back()->with('error', 'No se pudo conectar con GsmPay. Intenta de nuevo.');
        }

        $data = $response->json();

        if (
            ! isset($data['status'], $data['checkoutID'], $data['checkoutUrl']) ||
            $data['status'] !== 'success'
        ) {
            $this->updatePendingLog($user, [
                'response_data' => json_encode($data),
                'status'        => 'failed',
            ]);

            return back()->with('error', $data['message'] ?? 'Error al crear el pago con GsmPay.');
        }

        Cache::put('gsmpay_checkout_' . $data['checkoutID'], [
            'user_id'    => $user->id,
            'amount'     => $amount,
            'reference'  => $reference,
            'gateway_id' => $gateway->id,
        ], now()->addHours(2));

        $this->updatePendingLog($user, [
            'response_data' => json_encode($data),
            'status'        => 'redirected',
        ]);

        return redirect()->to($data['checkoutUrl']);
    }

    private function handleManualGateway(PaymentGateway $gateway, float $amount, User $user)
    {
        $this->updatePendingLog($user, [
            'response_data' => json_encode(['message' => 'Awaiting manual confirmation']),
            'status'        => 'awaiting',
        ]);

        return back()->with('info', 'Por favor completa el pago manual y contacta a soporte para confirmar.');
    }

    private function gatewayNotImplemented(PaymentGateway $gateway, float $amount, User $user)
    {
        $this->updatePendingLog($user, [
            'response_data' => json_encode(['message' => 'Gateway not implemented.']),
            'status'        => 'failed',
        ]);

        return back()->with('error', 'Este método de pago no está disponible aún. Por favor elige otro.');
    }

    /*
    |--------------------------------------------------------------------------
    | PRIVATE — Dispatcher de callbacks
    |--------------------------------------------------------------------------
    */
    private function processCallback(Request $request, string $gatewaySlug)
    {
        $gateway = PaymentGateway::where('slug', $gatewaySlug)->first();

        if (! $gateway) {
            return redirect()->route('funds.index')->with('error', 'Gateway de pago desconocido.');
        }

        return match ($gateway->type) {
            'piprapay' => $this->processPipraPayCallback($request, $gateway),
            'gsmpay'   => $this->processGsmPayCallback($request, $gateway),
            default    => redirect()->route('funds.index')->with('error', 'Callback no soportado para este gateway.'),
        };
    }

    /*
    |--------------------------------------------------------------------------
    | PRIVATE — PipraPay callback
    |
    | Parámetros que envía PipraPay:
    |   TrxID, CheckoutID, InvoiceID, Status="Paid"
    |--------------------------------------------------------------------------
    */
    private function processPipraPayCallback(Request $request, PaymentGateway $gateway)
    {
        $data = $request->all();

        Log::info('PipraPay callback recibido', $data);

        // Log inmediato del webhook
        PaymentGatewayLog::create([
            'payment_gateway_id' => $gateway->id,
            'user_id'            => null,
            'event_type'         => 'callback_' . $gateway->slug,
            'request_data'       => json_encode($data),
            'response_data'      => json_encode(['processing' => true]),
            'status'             => 'processing',
        ]);

        // Validar parámetros mínimos
        if (empty($data['TrxID']) || empty($data['CheckoutID']) || ($data['Status'] ?? '') !== 'Paid') {
            Log::warning('PipraPay callback inválido', $data);
            return redirect()->route('funds.index')
                ->with('error', 'El pago no fue completado o los datos son inválidos.');
        }

        $checkoutID = $data['CheckoutID'];

        // Recuperar datos guardados al crear el checkout
        $cached = Cache::get('piprapay_checkout_' . $checkoutID);

        if (! $cached) {
            Log::error('PipraPay cache no encontrado', ['checkoutID' => $checkoutID]);
            return redirect()->route('funds.index')
                ->with('error', 'Sesión de pago expirada. Contacta a soporte indicando tu TrxID: ' . $data['TrxID']);
        }

        $user      = User::find($cached['user_id']);
        $amount    = (float) $cached['amount'];
        $reference = $cached['reference'];
        $gatewayId = $cached['gateway_id'] ?? $gateway->id;

        if (! $user || $amount <= 0) {
            Log::error('PipraPay usuario o monto inválido', $cached);
            return redirect()->route('funds.index')
                ->with('error', 'Error al procesar el pago. Contacta a soporte.');
        }

        // Idempotencia: prevenir doble crédito si el webhook llega dos veces
        $alreadyCredited = FundLog::where('user_id', $user->id)
            ->where('description', 'like', "%{$reference}%")
            ->exists();

        if (! $alreadyCredited) {
            $this->creditUser(
                $user,
                $amount,
                $gatewayId,
                "{$gateway->name} [{$reference}] TrxID:{$data['TrxID']}"
            );

            Cache::forget('piprapay_checkout_' . $checkoutID);

            Log::info('PipraPay fondos acreditados', [
                'user_id'   => $user->id,
                'amount'    => $amount,
                'reference' => $reference,
                'TrxID'     => $data['TrxID'],
            ]);
        } else {
            Log::info('PipraPay callback duplicado ignorado', ['reference' => $reference]);
        }

        // Actualizar log a success
        PaymentGatewayLog::where('event_type', 'callback_' . $gateway->slug)
            ->where('status', 'processing')
            ->latest()
            ->first()
            ?->update([
                'user_id'       => $user->id,
                'response_data' => json_encode([
                    'verified'  => true,
                    'amount'    => $amount,
                    'reference' => $reference,
                    'TrxID'     => $data['TrxID'],
                ]),
                'status' => 'success',
            ]);

        return redirect()->route('funds.index')->with('success', '¡Fondos agregados exitosamente!');
    }

    /*
    |--------------------------------------------------------------------------
    | PRIVATE — GsmPay callback
    |
    | Parámetros que envía GsmPay:
    |   TrxID, CheckoutID, InvoiceID, Status="Paid"
    | Además verifica con: POST https://gsmpay.io/api/verify-payment
    |--------------------------------------------------------------------------
    */
    private function processGsmPayCallback(Request $request, PaymentGateway $gateway)
    {
        $data = $request->all();

        Log::info('GsmPay callback recibido', $data);

        PaymentGatewayLog::create([
            'payment_gateway_id' => $gateway->id,
            'user_id'            => null,
            'event_type'         => 'callback_' . $gateway->slug,
            'request_data'       => json_encode($data),
            'response_data'      => json_encode(['processing' => true]),
            'status'             => 'processing',
        ]);

        if (empty($data['TrxID']) || empty($data['CheckoutID']) || ($data['Status'] ?? '') !== 'Paid') {
            Log::warning('GsmPay callback inválido', $data);
            return redirect()->route('funds.index')->with('error', 'El pago no fue completado.');
        }

        $checkoutID = $data['CheckoutID'];

        // Verificación anti-fraude con la API de GsmPay
        $verify = Http::timeout(30)->post('https://gsmpay.io/api/verify-payment', [
            'TrxID'      => $data['TrxID'],
            'CheckoutID' => $checkoutID,
            'InvoiceID'  => $data['InvoiceID'] ?? null,
        ]);

        if (! $verify->successful() || ($verify->json()['Status'] ?? '') !== 'Paid') {
            Log::error('GsmPay verificación fallida', ['response' => $verify->json()]);
            return redirect()->route('funds.index')
                ->with('error', 'No se pudo verificar el pago con GsmPay.');
        }

        $cached = Cache::get('gsmpay_checkout_' . $checkoutID);

        if (! $cached) {
            return redirect()->route('funds.index')
                ->with('error', 'Sesión de pago expirada. Contacta a soporte indicando tu TrxID: ' . $data['TrxID']);
        }

        $user      = User::find($cached['user_id']);
        $amount    = (float) $cached['amount'];
        $reference = $cached['reference'];
        $gatewayId = $cached['gateway_id'] ?? $gateway->id;

        if (! $user || $amount <= 0) {
            return redirect()->route('funds.index')
                ->with('error', 'Error al procesar el pago. Contacta a soporte.');
        }

        $alreadyCredited = FundLog::where('user_id', $user->id)
            ->where('description', 'like', "%{$reference}%")
            ->exists();

        if (! $alreadyCredited) {
            $this->creditUser(
                $user,
                $amount,
                $gatewayId,
                "GsmPay [{$reference}] TrxID:{$data['TrxID']}"
            );

            Cache::forget('gsmpay_checkout_' . $checkoutID);

            Log::info('GsmPay fondos acreditados', [
                'user_id'   => $user->id,
                'amount'    => $amount,
                'reference' => $reference,
                'TrxID'     => $data['TrxID'],
            ]);
        } else {
            Log::info('GsmPay callback duplicado ignorado', ['reference' => $reference]);
        }

        PaymentGatewayLog::where('event_type', 'callback_' . $gateway->slug)
            ->where('status', 'processing')
            ->latest()
            ->first()
            ?->update([
                'user_id'       => $user->id,
                'response_data' => json_encode([
                    'verified'  => true,
                    'amount'    => $amount,
                    'reference' => $reference,
                    'TrxID'     => $data['TrxID'],
                ]),
                'status' => 'success',
            ]);

        return redirect()->route('funds.index')->with('success', '¡Fondos agregados exitosamente!');
    }
}