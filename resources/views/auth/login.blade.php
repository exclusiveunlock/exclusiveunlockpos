<x-modern-guest-layout>
<x-slot name="title">Login</x-slot>

{{-- Heading --}}
<div class="auth-heading">
    <h2>Welcome <span>Back</span></h2>
    <p>Sign in to access your firmware downloads</p>
</div>

{{-- Session status --}}
<x-auth-session-status class="mb-4" :status="session('status')" />

<form method="POST" action="{{ route('login') }}">
    @csrf

    {{-- Email --}}
    <div class="auth-field">
        <label for="email" class="auth-label">Email Address</label>
        <div class="auth-input-wrap">
            <div class="auth-input-icon">
                <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                </svg>
            </div>
            <input id="email" type="email" name="email"
                   value="{{ old('email') }}"
                   required autofocus autocomplete="username"
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
                   name="password" required autocomplete="current-password"
                   placeholder="••••••••"
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

    {{-- Remember + forgot --}}
    <div class="auth-row">
        <label class="auth-checkbox-label">
            <input type="checkbox" name="remember">
            Remember me for 30 days
        </label>
        @if(Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="auth-forgot">Forgot password?</a>
        @endif
    </div>

    {{-- Submit --}}
    <button type="submit" class="auth-submit">
        Sign In to Your Account
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
        </svg>
    </button>

    {{-- Divider --}}
    <div class="auth-divider">
        <span class="auth-divider-line"></span>
        <span>New to our platform?</span>
        <span class="auth-divider-line"></span>
    </div>

    {{-- Register --}}
    @if(Route::has('register'))
        <a href="{{ route('register') }}" class="auth-register">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
            Create New Account
        </a>
    @endif

</form>

{{-- Feature pills --}}
<div class="auth-features">
    <div class="auth-feat-item">
        <div class="auth-feat-icon">
            <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
        </div>
        <span class="auth-feat-label">Secure Login</span>
    </div>
    <div class="auth-feat-item">
        <div class="auth-feat-icon">
            <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
        </div>
        <span class="auth-feat-label">Fast Access</span>
    </div>
    <div class="auth-feat-item">
        <div class="auth-feat-icon">
            <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
        </div>
        <span class="auth-feat-label">24/7 Support</span>
    </div>
</div>

</x-modern-guest-layout>