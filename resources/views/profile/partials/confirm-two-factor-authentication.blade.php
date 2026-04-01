<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Confirm Two-Factor Authentication') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="mb-4">{{ __('Scan this QR code with your Google Authenticator app:') }}</p>
                    <img src="{{ $qrCodeUrl }}" alt="QR Code" class="mb-4">

                    <p class="mb-4">{{ __('Or enter this setup key:') }}</p>
                    <p class="font-mono text-sm text-gray-900 dark:text-gray-100 mb-4">{{ $secret }}</p>

                    <form method="POST" action="{{ route('2fa.confirm-enable') }}">
                        @csrf
                        <x-primary-button>
                            {{ __('Confirm Enable') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>