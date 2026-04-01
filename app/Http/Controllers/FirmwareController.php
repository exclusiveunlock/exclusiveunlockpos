<?php

namespace App\Http\Controllers;

use App\Models\Firmware;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FirmwareController extends Controller
{
    public function index(Request $request)
    {
        $firmware = Firmware::when($request->search, function($query, $search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            })
            ->when($request->folder, function($query, $folderId) {
                $query->where('folder_id', $folderId);
            })
            ->when($request->type, function($query, $type) {
                $query->where('type', $type);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        $folders = Folder::orderBy('name')->get();
        
        return view('firmware.index', compact('firmware', 'folders'));
    }
    
    public function show(Firmware $firmware)
    {
        // Incrementar contador de vistas
        $firmware->increment('views_count');
        
        // Obtener firmware relacionados de la misma carpeta
        $relatedFirmware = [];
        if ($firmware->folder_id) {
            $relatedFirmware = Firmware::where('folder_id', $firmware->folder_id)
                ->where('id', '!=', $firmware->id)
                ->take(5)
                ->get();
        }
        
        return view('firmware.show', compact('firmware', 'relatedFirmware'));
    }
     public function download($slug, Request $request)
    {
        // Buscar el firmware por slug
        $firmware = Firmware::where('slug', $slug)->firstOrFail();
        
        // VERIFICACIÓN 1: Usuario no autenticado (invitado)
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('warning', '⚠️ Debes iniciar sesión para descargar este firmware.')
                ->with('intended_url', route('firmware.download', $firmware->slug));
        }
        
        $user = auth()->user();
        
        // VERIFICACIÓN 2: Usuario autenticado pero sin paquete activo
        $hasActivePackage = $user->package_id && $user->package_expires_at && now()->lt($user->package_expires_at);
        
        if (!$hasActivePackage) {
            return redirect()->route('packages.index')
                ->with('error', '❌ Necesitas activar un paquete para poder descargar firmwares.')
                ->with('firmware_id', $firmware->id);
        }
        
        // VERIFICACIÓN 3: Verificar si el usuario ha excedido su límite de descargas diarias
        $package = \App\Models\Package::find($user->package_id);
        if ($package && $user->daily_files_used >= $package->daily_download_limit) {
            return back()->with('error', '⚠️ Has alcanzado el límite de descargas diarias de tu paquete.');
        }
        
        // VERIFICACIÓN 4: Verificar si es firmware de pago
        if ($firmware->type === 'Paid' && $firmware->price > 0) {
            // Verificar si el usuario ya ha comprado este firmware
            $hasPurchased = $user->purchasedFirmwares()->where('firmware_id', $firmware->id)->exists();
            
            if (!$hasPurchased && $user->balance < $firmware->price) {
                return redirect()->route('checkout', $firmware->id)
                    ->with('error', '💰 Este firmware requiere pago. Tu saldo es insuficiente.')
                    ->with('required_balance', $firmware->price)
                    ->with('current_balance', $user->balance);
            }
        }
        
        // VERIFICACIÓN 5: Verificar si el firmware está activo
        if (!$firmware->is_active) {
            abort(403, 'Este firmware no está disponible para descargar.');
        }
        
        // PROCESAR DESCARGA
        // Incrementar contadores
        $firmware->increment('downloads_count');
        $user->increment('daily_files_used');
        $user->increment('files_downloaded');
        
        // Registrar la descarga
        \App\Models\DownloadLog::create([
            'user_id' => $user->id,
            'firmware_id' => $firmware->id,
            'ip_address' => $request->ip(),
            'downloaded_at' => now(),
        ]);
        
        // Obtener la ruta del archivo
        $filePath = storage_path('app/public/uploads/' . $firmware->file_path);
        
        if (!file_exists($filePath)) {
            abort(404, 'Archivo no encontrado en el servidor.');
        }
        
        $fileName = $firmware->name . '.' . $firmware->file_extension;
        
        return response()->download($filePath, $fileName);
    }
    public function search(Request $request)
    {
        $searchTerm = $request->get('q');
        
        $firmware = Firmware::where('name', 'LIKE', "%{$searchTerm}%")
            ->orWhere('description', 'LIKE', "%{$searchTerm}%")
            ->take(10)
            ->get();
        
        if ($request->expectsJson()) {
            return response()->json($firmware);
        }
        
        return view('firmware.search', compact('firmware', 'searchTerm'));
    }
}