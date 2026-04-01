<div class="relative flex items-center" x-data="{ isOpen: false }" @click.outside="isOpen = false">
    <a href="{{ url('/') }}" target="_blank" class="relative flex items-center justify-center w-10 h-10 text-primary-500 rounded-full hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:text-primary-400 dark:hover:bg-primary-900 mr-2">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m0 0l7 7 7-7M19 10v10a1 1 0 001 1h3m-11 0a9 9 0 110-18 9 9 0 010 18z"></path>
        </svg>
    </a>

    <button wire:click="clearCache" class="relative flex items-center justify-center w-10 h-10 text-primary-500 rounded-full hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:text-primary-400 dark:hover:bg-primary-900 mr-2">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
        </svg>
    </button>

    <button @click="isOpen = !isOpen" class="relative flex items-center justify-center w-10 h-10 text-primary-500 rounded-full hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:text-primary-400 dark:hover:bg-primary-900">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
        </svg>
        @if(count($notifications) > 0)
            <span class="absolute -top-1 -right-1 flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-danger-500 rounded-full">{{ count($notifications) }}</span>
        @endif
    </button>

    <div x-show="isOpen" x-cloak class="fixed inset-0 z-50 overflow-hidden" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
        <div class="absolute inset-0 overflow-hidden">
            <div x-show="isOpen" x-transition:enter="ease-in-out duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-500" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="isOpen = false" aria-hidden="true"></div>
            <div class="fixed inset-y-0 right-0 pl-10 max-w-full flex">
                <div x-show="isOpen" x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" class="w-screen max-w-md">
                    <div class="h-full flex flex-col py-6 bg-white shadow-xl overflow-y-scroll dark:bg-gray-800">
                        <div class="px-4 sm:px-6">
                            <div class="flex items-start justify-between">
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100" id="slide-over-title">
                                    Notifications
                                </h2>
                                <div class="ml-3 h-7 flex items-center">
                                    <button @click="isOpen = false" type="button" class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:bg-gray-800 dark:text-gray-500 dark:hover:text-gray-400">
                                        <span class="sr-only">Close panel</span>
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 relative flex-1 px-4 sm:px-6">

                        <div class="py-1" role="none">
                            @forelse($notifications as $notification)
                                <a href="#" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700 notification-item" role="menuitem">
                                    <p class="font-semibold">{{ $notification['title'] }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $notification['body'] }}</p>
                                    <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">{{ $notification['time'] }}</p>
                                </a>
                            @empty
                                <p class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400">No new notifications</p>
                            @endforelse
                            <div class="px-4 py-2 text-sm text-center text-gray-700 border-t border-gray-200 dark:text-gray-200 dark:border-gray-700">
                                <a href="#" class="font-semibold hover:underline">View all notifications</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
