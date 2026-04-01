<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Reseller Profile Card -->
            <div class="card mb-8 transform transition-transform duration-300 hover:scale-[1.01] animate-fade-in-up">
                <div class="card-body">
                    <div class="flex flex-col md:flex-row items-center space-y-6 md:space-y-0 md:space-x-8">
                        <div class="relative group">
                            <div class="w-32 h-32 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center shadow-lg transform transition-transform duration-300 group-hover:rotate-6">
                                <span class="text-4xl font-bold text-white">{{ substr($user->name, 0, 2) }}</span>
                            </div>
                        </div>
                        <div class="text-center md:text-left flex-1">
                            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $user->name }}</h2>
                            <p class="text-lg text-gray-600 dark:text-gray-400 mb-3">{{ $user->email }}</p>
                            @if($user->resellerProfile && $user->resellerProfile->profile_text)
                                <p class="text-gray-700 dark:text-gray-300 mt-4">{{ $user->resellerProfile->profile_text }}</p>
                            @endif
                        </div>
                    </div>

                    @if($user->resellerProfile && $user->resellerProfile->social_links)
                        <div class="mt-8 border-t border-gray-200 dark:border-gray-700 pt-6">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Connect with {{ $user->name }}</h3>
                            <div class="flex flex-wrap gap-4">
                                @foreach($user->resellerProfile->social_links as $link)
                                    <a href="{{ $link['url'] }}" target="_blank" class="flex items-center space-x-2 px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200">
                                        <!-- You can add specific icons here based on platform, e.g., using Font Awesome -->
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.493-3.89 3.776-3.89 1.094 0 2.24.195 2.24.195v2.453h-1.26c-1.247 0-1.64.776-1.64 1.578V12h2.77l-.44 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12 22 6.477 17.523 2 12 2z"/></svg>
                                        <span>{{ $link['platform'] }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
