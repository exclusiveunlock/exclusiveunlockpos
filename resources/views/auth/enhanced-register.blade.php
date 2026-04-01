<x-modern-guest-layout>
    <x-slot name="title">Register</x-slot>

    <div class="text-center mb-8">
        <div class="w-16 h-16 bg-gradient-to-br from-green-500 via-blue-600 to-purple-500 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xl">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
            </svg>
        </div>
        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white mb-3">Create Account</h2>
        <p class="text-base sm:text-lg text-gray-600 dark:text-gray-400">Join thousands of users accessing premium firmware</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div class="space-y-2">
            <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                Full Name
            </label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <input id="name" 
                       type="text" 
                       name="name" 
                       value="{{ old('name') }}" 
                       required 
                       autofocus 
                       autocomplete="name"
                       class="w-full pl-12 pr-4 py-4 text-base sm:text-lg bg-white/95 dark:bg-gray-800/95 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 rounded-xl shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-300 hover:shadow-xl @error('name') border-red-500 dark:border-red-400 focus:ring-red-500/20 @enderror"
                       placeholder="Enter your full name">
            </div>
            @error('name')
                <p class="text-sm text-red-600 dark:text-red-400 flex items-center bg-red-50 dark:bg-red-900/20 px-3 py-2 rounded-lg">
                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="space-y-2">
            <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                Email Address
            </label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                    </svg>
                </div>
                <input id="email" 
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       autocomplete="username"
                       class="w-full pl-12 pr-4 py-4 text-base sm:text-lg bg-white/95 dark:bg-gray-800/95 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 rounded-xl shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-300 hover:shadow-xl @error('email') border-red-500 dark:border-red-400 focus:ring-red-500/20 @enderror"
                       placeholder="Enter your email address">
            </div>
            @error('email')
                <p class="text-sm text-red-600 dark:text-red-400 flex items-center bg-red-50 dark:bg-red-900/20 px-3 py-2 rounded-lg">
                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                Password
            </label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <input id="password" 
                       type="password" 
                       name="password" 
                       required 
                       autocomplete="new-password"
                       class="w-full pl-12 pr-4 py-4 text-base sm:text-lg bg-white/95 dark:bg-gray-800/95 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 rounded-xl shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-300 hover:shadow-xl @error('password') border-red-500 dark:border-red-400 focus:ring-red-500/20 @enderror"
                       placeholder="Create a strong password">
            </div>
            @error('password')
                <p class="text-sm text-red-600 dark:text-red-400 flex items-center bg-red-50 dark:bg-red-900/20 px-3 py-2 rounded-lg">
                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="space-y-2">
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                Confirm Password
            </label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <input id="password_confirmation" 
                       type="password" 
                       name="password_confirmation" 
                       required 
                       autocomplete="new-password"
                       class="w-full pl-12 pr-4 py-4 text-base sm:text-lg bg-white/95 dark:bg-gray-800/95 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 rounded-xl shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-300 hover:shadow-xl @error('password_confirmation') border-red-500 dark:border-red-400 focus:ring-red-500/20 @enderror"
                       placeholder="Confirm your password">
            </div>
            @error('password_confirmation')
                <p class="text-sm text-red-600 dark:text-red-400 flex items-center bg-red-50 dark:bg-red-900/20 px-3 py-2 rounded-lg">
                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Terms and Conditions -->
        <div class="flex items-start space-x-3 p-4 bg-gray-50 dark:bg-gray-800/50 rounded-xl">
            <input id="terms" 
                   type="checkbox" 
                   name="terms"
                   required
                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded transition-colors duration-200 mt-1">
            <label for="terms" class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                I agree to the <a href="#" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium">Terms of Service</a> and <a href="#" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium">Privacy Policy</a>
            </label>
        </div>

        <!-- Register Button -->
        <button type="submit" 
                class="w-full bg-gradient-to-r from-green-600 to-blue-600 hover:from-green-700 hover:to-blue-700 text-white font-semibold py-4 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-[1.02] focus:outline-none focus:ring-4 focus:ring-green-500/20">
            <div class="flex items-center justify-center">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                Create Account
            </div>
        </button>

        <!-- Divider -->
        <div class="relative my-8">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-4 bg-white dark:bg-gray-900 text-gray-500 dark:text-gray-400 font-medium">
                    Already have an account?
                </span>
            </div>
        </div>

        <!-- Login Link -->
        <div class="text-center">
            <a href="{{ route('login') }}" 
               class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-3 bg-white/90 dark:bg-gray-800/90 text-gray-900 dark:text-white font-semibold rounded-xl border border-gray-200/50 dark:border-gray-700/50 hover:bg-gray-50 dark:hover:bg-gray-800 transition-all duration-300 hover:scale-[1.02] shadow-lg backdrop-blur-sm">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
                Sign In Instead
            </a>
        </div>
    </form>

    <!-- Benefits Section -->
    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 text-center">Why Join Us?</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="flex items-center p-3 rounded-lg bg-green-50 dark:bg-green-900/20">
                <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                </svg>
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">10,000+ Firmware Files</span>
            </div>
            <div class="flex items-center p-3 rounded-lg bg-blue-50 dark:bg-blue-900/20">
                <svg class="w-6 h-6 text-blue-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Fast Downloads</span>
            </div>
            <div class="flex items-center p-3 rounded-lg bg-purple-50 dark:bg-purple-900/20">
                <svg class="w-6 h-6 text-purple-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Secure & Verified</span>
            </div>
            <div class="flex items-center p-3 rounded-lg bg-orange-50 dark:bg-orange-900/20">
                <svg class="w-6 h-6 text-orange-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.25a9.75 9.75 0 109.75 9.75c0-5.385-4.365-9.75-9.75-9.75z"></path>
                </svg>
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">24/7 Support</span>
            </div>
        </div>
    </div>
</x-modern-guest-layout>

