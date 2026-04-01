<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-green-50 via-white to-blue-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 flex items-center justify-center">
        <div class="max-w-md mx-auto p-8 bg-white dark:bg-gray-800 rounded-lg shadow-xl text-center transform transition-all duration-500 scale-95 hover:scale-100">
            <div class="text-green-500 mb-6">
                <svg class="w-24 h-24 mx-auto animate-bounce-in" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-4 animate-fade-in-down">
                Congratulations!
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-300 mb-8 animate-fade-in-up">
                Your package has been successfully activated.
            </p>
            <p class="text-sm text-gray-500 dark:text-gray-400 animate-fade-in-up animation-delay-200">
                You will be redirected to your dashboard shortly...
            </p>
        </div>
    </div>

    <meta http-equiv="refresh" content="3;url={{ route('dashboard') }}">

    <style>
        @keyframes bounceIn {
            0% { transform: scale(0.1); opacity: 0; }
            60% { transform: scale(1.2); opacity: 1; }
            100% { transform: scale(1); }
        }
        .animate-bounce-in { animation: bounceIn 0.8s ease-out forwards; }
        .animate-fade-in-down { animation: fadeInDown 0.6s ease-out forwards; }
        .animate-fade-in-up { animation: fadeInUp 0.6s ease-out forwards; }
        .animation-delay-200 { animation-delay: 0.2s; }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</x-app-layout>
