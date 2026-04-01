<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Profile Settings</h1>
                <p class="text-xl text-gray-600 dark:text-gray-400">Manage your account settings and preferences</p>
            </div>

            <!-- Profile Overview Card -->
            <div class="card mb-8">
                <div class="card-body">
                    <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-6">
                        <div class="relative">
                            <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                <span class="text-2xl font-bold text-white">{{ substr(auth()->user()->name, 0, 2) }}</span>
                            </div>
                            <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-500 rounded-full border-4 border-white dark:border-gray-800 flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="text-center md:text-left flex-1">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ auth()->user()->name }}</h2>
                            <p class="text-gray-600 dark:text-gray-400">{{ auth()->user()->email }}</p>
                            <div class="flex flex-wrap justify-center md:justify-start gap-2 mt-3">
                                <span class="badge-free">Active Member</span>
                                <span class="badge-featured">Verified Email</span>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold gradient-text">{{ auth()->user()->downloads_count ?? 0 }}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Downloads</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Tabs -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Sidebar Navigation -->
                <div class="lg:col-span-1">
                    <nav class="space-y-2" x-data="{ activeTab: 'profile' }">
                        <button @click="activeTab = 'profile'" 
                                :class="activeTab === 'profile' ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 border-blue-200 dark:border-blue-800' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-700'"
                                class="w-full text-left px-4 py-3 rounded-lg border transition-colors duration-200 flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>Profile Information</span>
                        </button>
                        <button @click="activeTab = 'security'" 
                                :class="activeTab === 'security' ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 border-blue-200 dark:border-blue-800' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-700'"
                                class="w-full text-left px-4 py-3 rounded-lg border transition-colors duration-200 flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            <span>Security</span>
                        </button>
                        <button @click="activeTab = 'preferences'" 
                                :class="activeTab === 'preferences' ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 border-blue-200 dark:border-blue-800' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-700'"
                                class="w-full text-left px-4 py-3 rounded-lg border transition-colors duration-200 flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Preferences</span>
                        </button>
                        <button @click="activeTab = 'danger'" 
                                :class="activeTab === 'danger' ? 'bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 border-red-200 dark:border-red-800' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-700'"
                                class="w-full text-left px-4 py-3 rounded-lg border transition-colors duration-200 flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            <span>Danger Zone</span>
                        </button>
                    </nav>
                </div>

                <!-- Content Area -->
                <div class="lg:col-span-3">
                    <!-- Profile Information Tab -->
                    <div x-show="activeTab === 'profile'" x-transition class="card">
                        <div class="card-body">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">Profile Information</h3>
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <!-- Security Tab -->
                    <div x-show="activeTab === 'security'" x-transition class="space-y-6">
                        <!-- Change Password -->
                        <div class="card">
                            <div class="card-body">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">Change Password</h3>
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>

                        <!-- Two-Factor Authentication -->
                        <div class="card">
                            <div class="card-body">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">Two-Factor Authentication</h3>
                                @include('profile.partials.enable-two-factor-authentication-form')
                            </div>
                        </div>
                    </div>

                    <!-- Preferences Tab -->
                    <div x-show="activeTab === 'preferences'" x-transition class="card">
                        <div class="card-body">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">Preferences</h3>
                            
                            <div class="space-y-6">
                                <!-- Theme Preference -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Theme Preference</label>
                                    <div class="grid grid-cols-3 gap-3">
                                        <label class="relative cursor-pointer">
                                            <input type="radio" name="theme" value="light" class="sr-only peer">
                                            <div class="p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg peer-checked:border-blue-500 peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/20 transition-colors duration-200">
                                                <div class="flex items-center space-x-3">
                                                    <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                                    </svg>
                                                    <span class="text-sm font-medium">Light</span>
                                                </div>
                                            </div>
                                        </label>
                                        <label class="relative cursor-pointer">
                                            <input type="radio" name="theme" value="dark" class="sr-only peer">
                                            <div class="p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg peer-checked:border-blue-500 peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/20 transition-colors duration-200">
                                                <div class="flex items-center space-x-3">
                                                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                                                    </svg>
                                                    <span class="text-sm font-medium">Dark</span>
                                                </div>
                                            </div>
                                        </label>
                                        <label class="relative cursor-pointer">
                                            <input type="radio" name="theme" value="auto" class="sr-only peer" checked>
                                            <div class="p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg peer-checked:border-blue-500 peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/20 transition-colors duration-200">
                                                <div class="flex items-center space-x-3">
                                                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                    </svg>
                                                    <span class="text-sm font-medium">Auto</span>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <!-- Email Notifications -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Email Notifications</label>
                                    <div class="space-y-3">
                                        <label class="flex items-center">
                                            <input type="checkbox" checked class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <span class="ml-3 text-sm text-gray-700 dark:text-gray-300">New firmware releases</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" checked class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <span class="ml-3 text-sm text-gray-700 dark:text-gray-300">Security alerts</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <span class="ml-3 text-sm text-gray-700 dark:text-gray-300">Marketing emails</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="pt-4">
                                    <button type="submit" class="btn-primary">Save Preferences</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Danger Zone Tab -->
                    <div x-show="activeTab === 'danger'" x-transition class="card border-red-200 dark:border-red-800">
                        <div class="card-body">
                            <h3 class="text-xl font-semibold text-red-600 dark:text-red-400 mb-6">Danger Zone</h3>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

