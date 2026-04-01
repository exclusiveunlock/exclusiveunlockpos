<x-modern-guest-layout>
<x-slot name="title">Register</x-slot>

<style>
/* Reutiliza exactamente las mismas clases de login.blade.php
   — auth-field, auth-label, auth-input, auth-error, etc.
   Solo se agregan las clases específicas del select y terms. */

.auth-heading { text-align: center; margin-bottom: 28px; }
.auth-heading h2 {
    font-size: 22px; font-weight: 800;
    color: var(--ef-text); margin: 0 0 6px; letter-spacing: -0.4px;
}
.auth-heading h2 span { color: var(--ef-mint); }
.auth-heading p { font-size: 13px; color: var(--ef-muted); margin: 0; }

.auth-field { margin-bottom: 16px; }

.auth-label {
    display: block; font-size: 12px; font-weight: 700;
    color: var(--ef-text2); margin-bottom: 6px; letter-spacing: 0.3px;
}

.auth-input-wrap { position: relative; }

.auth-input-icon {
    position: absolute; left: 12px; top: 50%; transform: translateY(-50%);
    pointer-events: none; display: flex;
}
.auth-input-icon svg { width: 16px; height: 16px; stroke: var(--ef-muted); transition: stroke 0.15s; }
.auth-input-wrap:focus-within .auth-input-icon svg { stroke: var(--ef-teal); }

.auth-input,
.auth-select {
    width: 100%;
    padding: 10px 12px 10px 40px;
    background: var(--ef-surface);
    border: 1px solid var(--ef-border);
    border-radius: 8px;
    font-size: 14px;
    color: var(--ef-text);
    outline: none;
    transition: border-color 0.15s, box-shadow 0.15s;
    -webkit-appearance: none;
    appearance: none;
}
.auth-input::placeholder { color: var(--ef-muted); }
.auth-select { cursor: pointer; }

.auth-input:focus,
.auth-select:focus {
    border-color: var(--ef-teal);
    box-shadow: 0 0 0 3px rgba(26,168,122,0.12);
}
.auth-input.has-error,
.auth-select.has-error { border-color: #c0392b; }
.auth-input.has-error:focus,
.auth-select.has-error:focus { box-shadow: 0 0 0 3px rgba(192,57,43,0.12); }

/* right toggle for password */
.auth-input-right {
    position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
    display: flex; align-items: center;
    background: none; border: none; cursor: pointer; padding: 0;
}
.auth-input-right svg { width: 16px; height: 16px; stroke: var(--ef-muted); transition: stroke 0.15s; }
.auth-input-right:hover svg { stroke: var(--ef-teal); }

/* select chevron */
.auth-select-chevron {
    position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
    pointer-events: none;
}
.auth-select-chevron svg { width: 14px; height: 14px; stroke: var(--ef-muted); }

/* select option colors */
.auth-select option {
    background: var(--ef-surface);
    color: var(--ef-text);
}

.auth-error {
    display: flex; align-items: center; gap: 5px;
    font-size: 12px; color: #c0392b; margin-top: 5px;
}
.auth-error svg { width: 13px; height: 13px; flex-shrink: 0; }

/* Terms row */
.auth-terms {
    display: flex; align-items: flex-start; gap: 10px;
    margin-bottom: 18px;
}
.auth-terms input[type="checkbox"] {
    width: 15px; height: 15px; margin-top: 2px;
    accent-color: var(--ef-teal); cursor: pointer; flex-shrink: 0;
}
.auth-terms-text {
    font-size: 13px; color: var(--ef-muted); line-height: 1.5;
}
.auth-terms-text a {
    color: var(--ef-teal); font-weight: 700; text-decoration: none; transition: color 0.15s;
}
.auth-terms-text a:hover { color: var(--ef-mint); }

/* Submit */
.auth-submit {
    width: 100%; padding: 12px;
    background: var(--ef-teal); color: #fff;
    border: none; border-radius: 8px;
    font-size: 14px; font-weight: 700;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center; gap: 8px;
    transition: opacity 0.15s, transform 0.15s;
    letter-spacing: 0.2px; margin-bottom: 20px;
}
.auth-submit:hover { opacity: 0.87; transform: translateY(-1px); }
.auth-submit svg { width: 16px; height: 16px; transition: transform 0.15s; }
.auth-submit:hover svg { transform: scale(1.1); }

/* Divider */
.auth-divider {
    display: flex; align-items: center; gap: 12px; margin: 4px 0 20px;
}
.auth-divider-line { flex: 1; height: 1px; background: var(--ef-border); }
.auth-divider span { font-size: 11px; color: var(--ef-muted); white-space: nowrap; font-weight: 500; }

/* Login link */
.auth-login {
    display: flex; align-items: center; justify-content: center; gap: 8px;
    width: 100%; padding: 11px;
    background: var(--ef-surface);
    border: 1px solid var(--ef-border);
    border-radius: 8px;
    font-size: 14px; font-weight: 700;
    color: var(--ef-text2); text-decoration: none;
    transition: border-color 0.15s, color 0.15s;
    margin-bottom: 24px;
}
.auth-login:hover { border-color: var(--ef-teal); color: var(--ef-mint); }
.auth-login svg { width: 16px; height: 16px; transition: transform 0.15s; }
.auth-login:hover svg { transform: translateX(3px); }

/* Feature pills */
.auth-features {
    border-top: 1px solid var(--ef-border);
    padding-top: 20px;
    display: grid; grid-template-columns: repeat(3,1fr); gap: 12px; text-align: center;
}
.auth-feat-item { display: flex; flex-direction: column; align-items: center; gap: 7px; }
.auth-feat-icon {
    width: 34px; height: 34px;
    background: var(--ef-teal-bg); border: 1px solid var(--ef-teal);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
}
.auth-feat-icon svg { width: 15px; height: 15px; stroke: var(--ef-mint); }
.auth-feat-label { font-size: 11px; color: var(--ef-muted); font-weight: 500; }
</style>

{{-- Heading --}}
<div class="auth-heading">
    <h2>Create <span>Account</span></h2>
    <p>Join us to access premium firmware downloads</p>
</div>

<form method="POST" action="{{ route('register') }}">
    @csrf

    {{-- Name --}}
    <div class="auth-field">
        <label for="name" class="auth-label">Full Name</label>
        <div class="auth-input-wrap">
            <div class="auth-input-icon">
                <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <input id="name" type="text" name="name" value="{{ old('name') }}"
                   required autofocus autocomplete="name"
                   placeholder="Your full name"
                   class="auth-input {{ $errors->has('name') ? 'has-error' : '' }}">
        </div>
        @error('name')
            <p class="auth-error">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ $message }}
            </p>
        @enderror
    </div>

    {{-- Email --}}
    <div class="auth-field">
        <label for="email" class="auth-label">Email Address</label>
        <div class="auth-input-wrap">
            <div class="auth-input-icon">
                <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                </svg>
            </div>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   required autocomplete="username"
                   placeholder="your@email.com"
                   class="auth-input {{ $errors->has('email') ? 'has-error' : '' }}">
        </div>
        @error('email')
            <p class="auth-error">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ $message }}
            </p>
        @enderror
    </div>

    {{-- Currency --}}
    <div class="auth-field">
        <label for="currency_id" class="auth-label">Currency</label>
        <div class="auth-input-wrap">
            <div class="auth-input-icon">
                <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                </svg>
            </div>
            <select id="currency_id" name="currency_id" required
                    class="auth-select {{ $errors->has('currency_id') ? 'has-error' : '' }}">
                @foreach($currencies as $currency)
                    <option value="{{ $currency->id }}" {{ old('currency_id') == $currency->id ? 'selected' : '' }}>
                        {{ $currency->name }} ({{ $currency->symbol }})
                    </option>
                @endforeach
            </select>
            <div class="auth-select-chevron">
                <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
            </div>
        </div>
        @error('currency_id')
            <p class="auth-error">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ $message }}
            </p>
        @enderror
    </div>

    {{-- Password --}}
    <div class="auth-field">
        <label for="password" class="auth-label">Password</label>
        <div class="auth-input-wrap" x-data="{ show: false }">
            <div class="auth-input-icon">
                <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <input id="password" :type="show ? 'text' : 'password'"
                   name="password" required autocomplete="new-password"
                   placeholder="Create a strong password"
                   class="auth-input {{ $errors->has('password') ? 'has-error' : '' }}"
                   style="padding-right:40px;">
            <button type="button" class="auth-input-right" @click="show = !show" tabindex="-1">
                <svg x-show="!show" fill="none" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                <svg x-show="show" fill="none" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
                </svg>
            </button>
        </div>
        @error('password')
            <p class="auth-error">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ $message }}
            </p>
        @enderror
    </div>

    {{-- Confirm Password --}}
    <div class="auth-field">
        <label for="password_confirmation" class="auth-label">Confirm Password</label>
        <div class="auth-input-wrap" x-data="{ show: false }">
            <div class="auth-input-icon">
                <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <input id="password_confirmation" :type="show ? 'text' : 'password'"
                   name="password_confirmation" required autocomplete="new-password"
                   placeholder="Confirm your password"
                   class="auth-input {{ $errors->has('password_confirmation') ? 'has-error' : '' }}"
                   style="padding-right:40px;">
            <button type="button" class="auth-input-right" @click="show = !show" tabindex="-1">
                <svg x-show="!show" fill="none" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                <svg x-show="show" fill="none" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
                </svg>
            </button>
        </div>
        @error('password_confirmation')
            <p class="auth-error">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ $message }}
            </p>
        @enderror
    </div>

    {{-- Terms --}}
    <div class="auth-terms">
        <input type="checkbox" name="terms" required>
        <span class="auth-terms-text">
            I agree to the
            <a href="#">Terms of Service</a>
            and
            <a href="#">Privacy Policy</a>
        </span>
    </div>

    {{-- Submit --}}
    <button type="submit" class="auth-submit">
        Create Your Account
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
        </svg>
    </button>

    {{-- Divider --}}
    <div class="auth-divider">
        <span class="auth-divider-line"></span>
        <span>Already have an account?</span>
        <span class="auth-divider-line"></span>
    </div>

    {{-- Login link --}}
    <a href="{{ route('login') }}" class="auth-login">
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
        </svg>
        Sign In Instead
    </a>

</form>

{{-- Feature pills --}}
<div class="auth-features">
    <div class="auth-feat-item">
        <div class="auth-feat-icon">
            <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <span class="auth-feat-label">Free to Join</span>
    </div>
    <div class="auth-feat-item">
        <div class="auth-feat-icon">
            <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
        </div>
        <span class="auth-feat-label">Secure Data</span>
    </div>
    <div class="auth-feat-item">
        <div class="auth-feat-icon">
            <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
        </div>
        <span class="auth-feat-label">Instant Access</span>
    </div>
</div>

{{-- Toast error --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const msg = '{{ session('error') }}';
    if (!msg) return;
    const t = document.createElement('div');
    t.textContent = msg;
    Object.assign(t.style, {
        position:'fixed', bottom:'20px', right:'20px',
        background:'#c0392b', color:'#fff',
        padding:'10px 18px', borderRadius:'7px',
        fontSize:'13px', fontWeight:'600',
        zIndex:'1000', opacity:'0',
        transition:'opacity 0.3s ease'
    });
    document.body.appendChild(t);
    setTimeout(() => t.style.opacity = '1', 50);
    setTimeout(() => { t.style.opacity = '0'; t.addEventListener('transitionend', () => t.remove()); }, 5000);
});
</script>

</x-modern-guest-layout>