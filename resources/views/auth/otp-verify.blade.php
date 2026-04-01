<x-modern-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 p-4">
        <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-3xl shadow-2xl p-8 space-y-6 border border-gray-200 dark:border-gray-700 transform transition-all duration-300 hover:scale-[1.01] animate-fade-in-up">
            <div class="flex justify-center mb-6">
                <a href="/">
                    <x-authentication-card-logo class="w-24 h-24" />
                </a>
            </div>

            <h2 class="text-3xl font-extrabold text-center text-gray-900 dark:text-white leading-tight mb-2 animate-fade-in-down">
                Verify <span class="gradient-text">OTP</span>
            </h2>
            <p class="text-center text-gray-600 dark:text-gray-400 mb-8 animate-fade-in-down animation-delay-100">
                An OTP has been sent to <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $email }}</span>. Please enter it below.
            </p>

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('otp.verify') }}" class="space-y-6">
                @csrf

                <input type="hidden" name="email" value="{{ $email }}">

                <div>
                    <label for="otp" class="sr-only">OTP</label>
                    <input 
                        id="otp" 
                        class="form-input-enhanced text-center text-3xl tracking-widest font-bold"
                        type="text" 
                        name="otp" 
                        required 
                        autofocus 
                        maxlength="6"
                        placeholder="••••••"
                    />
                </div>

                <button type="submit" class="w-full btn-primary py-3 text-lg animate-fade-in-up animation-delay-200">
                    Verify OTP
                </button>
            </form>

            <div class="text-center mt-6 animate-fade-in-up animation-delay-300">
                <a href="{{ route('otp.request') }}" 
                   class="text-sm text-gray-600 dark:text-gray-400 hover:underline">
                    Resend OTP
                </a>
            </div>
        </div>
    </div>
</x-modern-guest-layout>
