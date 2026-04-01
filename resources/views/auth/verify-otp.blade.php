<x-modern-guest-layout>
    <x-slot name="title">Verify OTP</x-slot>

    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Check your email</h2>
        <p class="text-lg text-gray-600 dark:text-gray-400">We've sent a 6-digit OTP to your email address.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('verify.otp') }}" class="space-y-6">
        @csrf

        <!-- Email Address (Hidden) -->
        <input type="hidden" name="email" value="{{ request()->query('email') }}">

        <!-- OTP -->
        <div class="space-y-2">
            <label for="otp" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                One-Time Password (OTP)
            </label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <input id="otp" 
                       type="text" 
                       name="otp" 
                       required 
                       autofocus 
                       class="w-full pl-12 pr-4 py-4 text-lg bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm border border-gray-200 dark:border-gray-700 rounded-2xl shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-300 @error('otp') border-red-500 dark:border-red-400 @enderror"
                       placeholder="Enter your 6-digit OTP">
            </div>
            @error('otp')
                <p class="text-sm text-red-600 dark:text-red-400 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" 
                class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold py-4 px-6 rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center space-x-3 group">
            <span class="text-lg">Verify Account</span>
            <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
            </svg>
        </button>
    </form>

    <form method="POST" action="{{ route('resend.otp') }}" class="mt-4">
        @csrf
        <input type="hidden" name="email" value="{{ request()->query('email') }}">
        <button type="submit" class="w-full text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-semibold transition-colors duration-200 hover:underline">
            Resend OTP
        </button>
    </form>
</x-modern-guest-layout>
