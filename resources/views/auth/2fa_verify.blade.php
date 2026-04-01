<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('2fa.verify') }}">
            @csrf

            <div class="mt-4">
                <x-label for="one_time_password" value="{{ __('One Time Password') }}" />
                <x-input id="one_time_password" class="block mt-1 w-full" type="text" name="one_time_password" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ms-4">
                    {{ __('Verify') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>