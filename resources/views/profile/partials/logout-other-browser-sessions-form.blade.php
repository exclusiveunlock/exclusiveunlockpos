<x-action-section>
    <x-slot name="title">
        {{ __('Browser Sessions') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Manage and log out your active sessions on other browsers and devices.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
            {{ __('If necessary, you may log out of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive.') }}
        </div>

        @if (count($this->sessions) > 0)
            <div class="mt-5 space-y-6">
                <!-- Other Browser Sessions -->
                @foreach ($this->sessions as $session)
                    <div class="flex items-center">
                        <div>
                            @if ($session->agent->isDesktop())
                                <svg class="w-8 h-8 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 172.25a2.25 2.25 0 002.25-2.25v-2.25a2.25 2.25 0 00-2.25-2.25H9.75a2.25 2.25 0 00-2.25 2.25v2.25a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                            @else
                                <svg class="w-8 h-8 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 18a8 8 0 100-16 8 8 0 000 16zM12 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            @endif
                        </div>

                        <div class="ms-3">
                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                {{ $session->agent->platform() ? $session->agent->platform() : 'Unknown' }} - {{ $session->agent->browser() ? $session->agent->browser() : 'Unknown' }}
                            </div>

                            <div>
                                <div class="text-xs text-gray-500">
                                    {{ $session->ip_address }}, 

                                    @if ($session->is_current_device)
                                        <span class="text-green-500 font-semibold">{{ __('This device') }}</span>
                                    @else
                                        {{ __('Last active') }} {{ $session->last_active }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="flex items-center mt-5">
            <x-button wire:click="confirmLogout" wire:loading.attr="disabled">
                {{ __('Log Out Other Browser Sessions') }}
            </x-button>

            <x-action-message class="ms-3" on="loggedOut">
                {{ __('Done.') }}
            </x-action-message>
        </div>

        <!-- Log Out Other Devices Confirmation Modal -->
        <x-dialog-modal wire:model.live="confirmingLogout">
            <x-slot name="title">
                {{ __('Log Out Other Browser Sessions') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Please enter your password to confirm you would like to log out of your other browser sessions across all of your devices.') }}

                <div class="mt-4" x-data="{}" x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-input type="password" class="mt-1 block w-3/4" placeholder="{{ __('Password') }}"
                                x-ref="password"
                                wire:model="password"
                                wire:keydown.enter="logoutOtherBrowserSessions" />

                    <x-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="hideConfirmingLogout" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-button class="ms-3" wire:click="logoutOtherBrowserSessions" wire:loading.attr="disabled">
                    {{ __('Log Out Other Browser Sessions') }}
                </x-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>