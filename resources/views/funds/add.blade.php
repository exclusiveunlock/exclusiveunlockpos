<x-app-layout>
<x-slot name="header">
    <div style="display:flex;align-items:center;gap:10px;">
        <div style="width:32px;height:32px;background:var(--ef-teal-bg);border:1px solid var(--ef-teal);border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <svg style="width:15px;height:15px;stroke:var(--ef-mint);" fill="none" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
        </div>
        <h2 style="font-size:18px;font-weight:800;color:var(--ef-text);margin:0;letter-spacing:-0.3px;">Add Funds</h2>
    </div>
</x-slot>

<style>
/* ── Add Funds page — variables --ef-* ── */
.af-page {
    max-width: 560px;
    margin: 32px auto;
    padding: 0 16px 64px;
}

/* ── Card ── */
.af-card {
    background: var(--ef-surface);
    border: 1px solid var(--ef-border);
    border-top: 3px solid var(--ef-teal);
    border-radius: 10px;
    overflow: hidden;
}

/* ── Card header ── */
.af-card-header {
    text-align: center;
    padding: 28px 28px 0;
}

.af-header-icon {
    width: 48px; height: 48px;
    background: var(--ef-teal-bg);
    border: 1px solid var(--ef-teal);
    border-radius: 11px;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 14px;
}
.af-header-icon svg { width: 22px; height: 22px; stroke: var(--ef-mint); }

.af-card-header h3 {
    font-size: 18px; font-weight: 800;
    color: var(--ef-text); margin: 0 0 6px; letter-spacing: -0.3px;
}
.af-card-header p { font-size: 13px; color: var(--ef-muted); margin: 0; }

/* ── Form body ── */
.af-form-body { padding: 24px 28px; }

/* ── Alerts ── */
.af-alert {
    display: flex; align-items: flex-start; gap: 10px;
    padding: 12px 14px; border-radius: 8px;
    font-size: 13px; font-weight: 600;
    margin-bottom: 18px;
}
.af-alert svg { width: 16px; height: 16px; flex-shrink: 0; fill: currentColor; }
.af-alert-error   { background: #1a0505; border: 1px solid #4a1515; color: #e05050; }
.af-alert-success { background: var(--ef-teal-bg); border: 1px solid var(--ef-teal); color: var(--ef-teal-text); }
html.dark .af-alert-success { color: var(--ef-mint); }

/* ── Field ── */
.af-field { margin-bottom: 18px; }

.af-label {
    display: block; font-size: 12px; font-weight: 700;
    color: var(--ef-text2); margin-bottom: 6px; letter-spacing: 0.3px;
}

.af-input-wrap { position: relative; }

.af-input-prefix {
    position: absolute; left: 12px; top: 50%; transform: translateY(-50%);
    font-size: 14px; font-weight: 700; color: var(--ef-muted);
    pointer-events: none;
}

.af-input,
.af-select {
    width: 100%;
    padding: 10px 12px 10px 36px;
    background: var(--ef-bg);
    border: 1px solid var(--ef-border);
    border-radius: 8px; font-size: 14px; color: var(--ef-text);
    outline: none; font-family: inherit;
    transition: border-color 0.15s, box-shadow 0.15s;
    -webkit-appearance: none; appearance: none;
}
.af-input::placeholder { color: var(--ef-muted); }
.af-input:focus,
.af-select:focus {
    border-color: var(--ef-teal);
    box-shadow: 0 0 0 3px rgba(26,168,122,0.1);
}
.af-input.has-error,
.af-select.has-error { border-color: #c0392b; }

.af-select { cursor: pointer; }
.af-select option { background: var(--ef-surface); color: var(--ef-text); }

.af-select-chevron {
    position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
    pointer-events: none;
}
.af-select-chevron svg { width: 14px; height: 14px; stroke: var(--ef-muted); }

/* No prefix for select */
.af-select-wrap .af-select { padding-left: 12px; }

.af-field-hint { font-size: 11px; color: var(--ef-muted); margin-top: 5px; }

.af-error { font-size: 12px; color: #c0392b; margin-top: 5px; }

/* ── Security notice ── */
.af-notice {
    display: flex; align-items: flex-start; gap: 11px;
    background: var(--ef-blue-bg);
    border: 1px solid var(--ef-blue);
    border-radius: 8px; padding: 12px 14px;
    margin-bottom: 20px;
}
.af-notice-icon { width: 16px; height: 16px; fill: var(--ef-blue-text); flex-shrink: 0; margin-top: 1px; }
html.dark .af-notice-icon { fill: var(--ef-blue-text); }
.af-notice h4 { font-size: 12px; font-weight: 700; color: var(--ef-blue-text); margin: 0 0 3px; }
.af-notice p  { font-size: 12px; color: var(--ef-blue-text); margin: 0; opacity: 0.85; }

/* ── Submit ── */
.af-submit {
    width: 100%; padding: 12px;
    background: var(--ef-teal); color: #fff;
    border: none; border-radius: 8px;
    font-size: 14px; font-weight: 700;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center; gap: 8px;
    transition: opacity 0.15s, transform 0.15s;
}
.af-submit:hover { opacity: 0.87; transform: translateY(-1px); }
.af-submit svg { width: 16px; height: 16px; }

/* ── Features row ── */
.af-features {
    border-top: 1px solid var(--ef-border);
    padding: 20px 28px 24px;
    display: grid;
    grid-template-columns: repeat(3,1fr);
    gap: 12px; text-align: center;
}

.af-feat-item { display: flex; flex-direction: column; align-items: center; gap: 7px; }

.af-feat-icon {
    width: 34px; height: 34px;
    background: var(--ef-teal-bg); border: 1px solid var(--ef-teal);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
}
.af-feat-icon svg { width: 15px; height: 15px; fill: var(--ef-mint); }
.af-feat-name  { font-size: 12px; font-weight: 700; color: var(--ef-text); margin: 0; }
.af-feat-label { font-size: 11px; color: var(--ef-muted); margin: 0; }
</style>

<div class="af-page">
    <div class="af-card">

        {{-- Header --}}
        <div class="af-card-header">
            <div class="af-header-icon">
                <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <h3>Add Funds to Your Account</h3>
            <p>Securely add funds using our trusted payment methods</p>
        </div>

        {{-- Form --}}
        <div class="af-form-body">

            {{-- Alerts --}}
            @if(session('error'))
                <div class="af-alert af-alert-error">
                    <svg viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="af-alert af-alert-success">
                    <svg viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('funds.add') }}" method="POST">
                @csrf

                {{-- Amount --}}
                <div class="af-field">
                    <label for="amount" class="af-label">Amount to Add</label>
                    <div class="af-input-wrap">
                        <span class="af-input-prefix">{{ Auth::user()->currency->symbol ?? '$' }}</span>
                        <input type="number" name="amount" id="amount"
                               step="0.01" min="1" required
                               value="{{ old('amount', $prefillAmount ?? '') }}"
                               placeholder="0.00"
                               class="af-input {{ $errors->has('amount') ? 'has-error' : '' }}">
                    </div>
                    @error('amount')
                        <p class="af-error">{{ $message }}</p>
                    @enderror
                    <p class="af-field-hint">Minimum amount: {{ Auth::user()->currency->symbol ?? '$' }}1.00</p>
                </div>

                {{-- Payment method --}}
                <div class="af-field">
                    <label for="payment_gateway_id" class="af-label">Payment Method</label>
                    <div class="af-input-wrap af-select-wrap">
                        <select name="payment_gateway_id" id="payment_gateway_id" required
                                class="af-select {{ $errors->has('payment_gateway_id') ? 'has-error' : '' }}"
                                style="padding-right:36px;">
                            <option value="">Select a payment method</option>
                            @foreach($paymentGateways as $gateway)
                                <option value="{{ $gateway->id }}" {{ old('payment_gateway_id') == $gateway->id ? 'selected' : '' }}>
                                    {{ $gateway->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="af-select-chevron">
                            <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                    @error('payment_gateway_id')
                        <p class="af-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Security notice --}}
                <div class="af-notice">
                    <svg class="af-notice-icon" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <h4>Secure Payment</h4>
                        <p>Your payment information is encrypted and processed securely. We never store your payment details.</p>
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit" class="af-submit">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Add Funds Securely
                </button>

            </form>
        </div>

        {{-- Features ── --}}
        <div class="af-features">
            <div class="af-feat-item">
                <div class="af-feat-icon">
                    <svg viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                </div>
                <p class="af-feat-name">Instant</p>
                <p class="af-feat-label">Funds added immediately</p>
            </div>
            <div class="af-feat-item">
                <div class="af-feat-icon">
                    <svg viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
                </div>
                <p class="af-feat-name">Secure</p>
                <p class="af-feat-label">Bank-level encryption</p>
            </div>
            <div class="af-feat-item">
                <div class="af-feat-icon">
                    <svg viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/></svg>
                </div>
                <p class="af-feat-name">Support</p>
                <p class="af-feat-label">24/7 here to help</p>
            </div>
        </div>

    </div>
</div>

</x-app-layout>