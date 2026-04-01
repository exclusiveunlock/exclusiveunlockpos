<x-modern-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 p-4">
        <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-3xl shadow-2xl p-8 space-y-6 border border-gray-200 dark:border-gray-700 transform transition-all duration-300 hover:scale-[1.01] animate-fade-in-up">
            <div class="flex justify-center mb-6">
                <a href="/">
                    <x-authentication-card-logo class="w-24 h-24" />
                </a>
            </div>

            <h2 class="text-3xl font-extrabold text-center text-gray-900 dark:text-white leading-tight mb-2 animate-fade-in-down">
                Request <span class="gradient-text">OTP</span>
            </h2>
            <p class="text-center text-gray-600 dark:text-gray-400 mb-8 animate-fade-in-down animation-delay-100">
                Enter your email address to receive a One-Time Password.
            </p>

            <x-validation-errors class="mb-4" />

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('otp.send') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="sr-only">Email</label>
                    <input 
                        id="email" 
                        class="form-input-enhanced"
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus 
                        placeholder="Email Address"
                    />
                </div>

                <button type="submit" class="w-full btn-primary py-3 text-lg animate-fade-in-up animation-delay-200">
                    Send OTP
                </button>
            </form>

            <div class="text-center mt-6 animate-fade-in-up animation-delay-300">
                <a href="{{ route('login') }}" 
                   class="text-sm text-gray-600 dark:text-gray-400 hover:underline">
                    Back to Login
                </a>
            </div>
        </div>
    </div>
</x-modern-guest-layout>
