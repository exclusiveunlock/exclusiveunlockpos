<x-modern-guest-layout>
    <x-slot name="title">Reset Password</x-slot>

    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Reset Your Password</h2>
        <p class="text-lg text-gray-600 dark:text-gray-400">Enter your new password below.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.reset', ['user' => $user->id]) }}" class="space-y-6">
        @csrf

        <!-- Password -->
        <div class="space-y-2">
            <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                Password
            </label>
            <div class="relative group" x-data="{ showPassword: false }">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <input id="password" 
                       :type="showPassword ? 'text' : 'password'"
                       name="password" 
                       required 
                       autocomplete="new-password"
                       class="w-full pl-12 pr-12 py-4 text-lg bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm border border-gray-200 dark:border-gray-700 rounded-2xl shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-300 @error('password') border-red-500 dark:border-red-400 @enderror"
                       placeholder="Enter your new password">
                <button type="button" 
                        @click="showPassword = !showPassword"
                        class="absolute inset-y-0 right-0 pr-4 flex items-center">
                    <svg x-show="!showPassword" class="h-5 w-5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    <svg x-show="showPassword" class="h-5 w-5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="text-sm text-red-600 dark:text-red-400 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <input id="password_confirmation" 
                       type="password"
                       name="password_confirmation" 
                       required 
                       autocomplete="new-password"
                       class="w-full pl-12 pr-4 py-4 text-lg bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm border border-gray-200 dark:border-gray-700 rounded-2xl shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-300"
                       placeholder="Confirm your new password">
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" 
                class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold py-4 px-6 rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center space-x-3 group">
            <span class="text-lg">Reset Password</span>
            <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
            </svg>
        </button>
    </form>
</x-modern-guest-layout>
