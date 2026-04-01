<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Two-Factor Authentication') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Add additional security to your account using two-factor authentication.') }}
        </p>
    </header>

    @if (session('status') == 'two-factor-authentication-enabled')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ __('Two-factor authentication has been enabled.') }}
        </div>
    @endif

    @if (Auth::user()->google2fa_secret)
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mt-5">
            {{ __('You have enabled two-factor authentication.') }}
        </h3>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("When two-factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone's Google Authenticator application.") }}
        </p>

        <form method="POST" action="{{ route('2fa.disable') }}" class="mt-5">
            @csrf
            <x-danger-button>
                {{ __('Disable') }}
            </x-danger-button>
        </form>
    @else
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mt-5">
            {{ __('You have not enabled two-factor authentication.') }}
        </h3>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("When two-factor authentication is enabled, you will be prompted for a secure, random token during authentication. To enable two-factor authentication, scan the following QR code using your phone's authenticator application or enter the setup key and provide the generated OTP.") }}
        </p>

        <div class="mt-4">
            <form method="POST" action="{{ route('2fa.enable') }}">
                @csrf
                <x-primary-button>
                    {{ __('Enable') }}
                </x-primary-button>
            </form>
        </div>
    @endif
</section>
