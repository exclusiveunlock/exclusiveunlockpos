<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-12">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12 animate-fade-in-down">
                <h1 class="text-5xl font-extrabold text-gray-900 dark:text-white mb-4 leading-tight">
                    Password <span class="gradient-text">Access</span>
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    Enter the file title to retrieve its password.
                </p>
            </div>

            <!-- Password Retrieval Card -->
            <div class="card animate-fade-in-up">
                <div class="card-body">
                    <form method="POST" action="{{ route('password.access.show') }}" class="space-y-6">
                        @csrf

                        <x-validation-errors class="mb-4" />

                        <div>
                            <label for="file_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">File Title</label>
                            <input type="text" id="file_title" name="file_title" class="form-input-enhanced" placeholder="Enter full file title" required autofocus>
                        </div>

                        <button type="submit" class="btn-primary w-full">
                            Get Password
                        </button>
                    </form>

                    @if(session('password'))
                        <div class="mt-8 p-6 bg-green-50 dark:bg-green-900/20 rounded-xl border border-green-200 dark:border-green-800 animate-fade-in">
                            <h3 class="text-xl font-semibold text-green-800 dark:text-green-300 mb-3">Password for {{ session('file_name') }}</h3>
                            <div class="relative">
                                <input type="text" value="{{ session('password') }}" readonly class="form-input-enhanced font-mono text-lg pr-12" id="filePassword">
                                <button type="button" onclick="copyPassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path>
                                    </svg>
                                </button>
                            </div>
                            <p class="text-sm text-green-700 dark:text-green-400 mt-2" id="copyMessage"></p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function copyPassword() {
            const passwordField = document.getElementById('filePassword');
            passwordField.select();
            passwordField.setSelectionRange(0, 99999); /* For mobile devices */
            document.execCommand('copy');

            const copyMessage = document.getElementById('copyMessage');
            copyMessage.textContent = 'Password copied to clipboard!';
            setTimeout(() => {
                copyMessage.textContent = '';
            }, 2000);
        }
    </script>
    @endpush
</x-app-layout>
