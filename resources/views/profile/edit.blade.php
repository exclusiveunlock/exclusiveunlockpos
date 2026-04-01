<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header with subtle animation -->
            <div class="text-center mb-12 animate-fade-in-down">
                <h1 class="text-5xl font-extrabold text-gray-900 dark:text-white mb-4 leading-tight">
                    Your <span class="gradient-text">Dashboard</span>
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    Manage your account, track your activity, and customize your experience.
                </p>
            </div>

            <!-- Profile Overview Card with hover animation -->
            <div class="card mb-8 transform transition-transform duration-300 hover:scale-[1.01] animate-fade-in-up">
                <div class="card-body">
                    <div class="flex flex-col md:flex-row items-center space-y-6 md:space-y-0 md:space-x-8">
                        <div class="relative group">
                            <div class="w-32 h-32 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center shadow-lg transform transition-transform duration-300 group-hover:rotate-6">
                                <span class="text-4xl font-bold text-white">{{ substr(auth()->user()->name, 0, 2) }}</span>
                            </div>
                            <div class="absolute -bottom-1 -right-1 w-10 h-10 bg-green-500 rounded-full border-4 border-white dark:border-gray-800 flex items-center justify-center transform transition-transform duration-300 group-hover:scale-110">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="text-center md:text-left flex-1">
                            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ auth()->user()->name }}</h2>
                            <p class="text-lg text-gray-600 dark:text-gray-400 mb-3">{{ auth()->user()->email }}</p>
                            <div class="flex flex-wrap justify-center md:justify-start gap-3 mt-3">
                                <span class="badge-free animate-bounce-in">Active Member</span>
                                <span class="badge-featured animate-bounce-in animation-delay-200">Verified Email</span>
                            </div>
                        </div>
                        <div class="text-center space-y-2">
                            <div class="text-4xl font-bold gradient-text animate-number-grow">{{ auth()->user()->total_files_used ?? 0 }}</div>
                            <div class="text-md text-gray-600 dark:text-gray-400">Total Downloads</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Tabs with fade-in animation -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 animate-fade-in-up animation-delay-400">
                <!-- Sidebar Navigation -->
                <div class="lg:col-span-1">
                    <nav class="space-y-3" x-data="{ activeTab: 
                                'profile' }">
                        <button @click="activeTab = 'profile'" 
                                :class="activeTab === 'profile' ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 border-blue-200 dark:border-blue-800 shadow-md' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-700 hover:border-blue-300 dark:hover:border-blue-700'"
                                class="w-full text-left px-5 py-3 rounded-xl border transition-all duration-300 flex items-center space-x-3 transform hover:-translate-y-0.5">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>Profile Information</span>
                        </button>
                        <a href="{{ route('security.index') }}" 
                                :class="activeTab === 'security' ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 border-blue-200 dark:border-blue-800 shadow-md' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-700 hover:border-blue-300 dark:hover:border-blue-700'"
                                class="w-full text-left px-5 py-3 rounded-xl border transition-all duration-300 flex items-center space-x-3 transform hover:-translate-y-0.5">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            <span>Security</span>
                        </a>
                        <button @click="activeTab = 'preferences'" 
                                :class="activeTab === 'preferences' ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 border-blue-200 dark:border-blue-800 shadow-md' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-700 hover:border-blue-300 dark:hover:border-blue-700'"
                                class="w-full text-left px-5 py-3 rounded-xl border transition-all duration-300 flex items-center space-x-3 transform hover:-translate-y-0.5">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Preferences</span>
                        </button>
                        
                    </nav>
                </div>

                <!-- Content Area with slide-in animation -->
                <div class="lg:col-span-3">
                    <!-- Profile Information Tab -->
                    <div x-show="activeTab === 'profile'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" class="card animate-fade-in">
                        <div class="card-body">
                            <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">Profile Information</h3>
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    

                    <!-- Preferences Tab -->
                    <div x-show="activeTab === 'preferences'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" class="card animate-fade-in">
                        <div class="card-body">
                            <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">Preferences</h3>
                            
                            <form method="post" action="{{ route('profile.preferences.update') }}" class="mt-6 space-y-6">
                                @csrf
                                @method('patch')

                                @if (session('status') === 'preferences-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-green-600 dark:text-green-400"
                                    >{{ __('Saved.') }}</p>
                                @endif

                                <div class="space-y-6">
                                    <!-- Theme Preference -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Theme Preference</label>
                                        <div class="grid grid-cols-3 gap-3">
                                            <label class="relative cursor-pointer">
                                                <input type="radio" name="theme" value="light" class="sr-only peer" {{ auth()->user()->theme === 'light' ? 'checked' : '' }}>
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
                                                <input type="radio" name="theme" value="dark" class="sr-only peer" {{ auth()->user()->theme === 'dark' ? 'checked' : '' }}>
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
                                                <input type="radio" name="theme" value="auto" class="sr-only peer" {{ auth()->user()->theme === 'auto' ? 'checked' : '' }}>
                                                <div class="p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg peer-checked:border-blue-500 peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/20 transition-colors duration-200">
                                                    <div class="flex items-center space-x-3">
                                                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                        </svg>
                                                        <span>Auto</span>
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
                                                <input type="checkbox" name="new_firmware_notifications" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" {{ auth()->user()->new_firmware_notifications ? 'checked' : '' }}>
                                                <span class="ml-3 text-sm text-gray-700 dark:text-gray-300">New firmware releases</span>
                                            </label>
                                            <label class="flex items-center">
                                                <input type="checkbox" name="security_alerts" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" {{ auth()->user()->security_alerts ? 'checked' : '' }}>
                                                <span class="ml-3 text-sm text-gray-700 dark:text-gray-300">Security alerts</span>
                                            </label>
                                            <label class="flex items-center">
                                                <input type="checkbox" name="marketing_emails" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" {{ auth()->user()->marketing_emails ? 'checked' : '' }}>
                                                <span class="ml-3 text-sm text-gray-700 dark:text-gray-300">Marketing emails</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="pt-4">
                                        <button type="submit" class="btn-primary">Save Preferences</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Keyframe Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes bounceIn {
            from, 20%, 40%, 60%, 80%, to { animation-timing-function: cubic-bezier(0.215, 0.610, 0.355, 1.000); }
            0% { opacity: 0; transform: scale3d(0.3, 0.3, 0.3); }
            20% { transform: scale3d(1.1, 1.1, 1.1); }
            40% { transform: scale3d(0.9, 0.9, 0.9); }
            60% { opacity: 1; transform: scale3d(1.03, 1.03, 1.03); }
            80% { transform: scale3d(0.97, 0.97, 0.97); }
            to { opacity: 1; transform: scale3d(1, 1, 1); }
        }

        @keyframes numberGrow {
            from { transform: scale(0.8); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        /* Apply Animations */
        .animate-fade-in { animation: fadeIn 0.5s ease-out forwards; }
        .animate-fade-in-down { animation: fadeInDown 0.6s ease-out forwards; }
        .animate-fade-in-up { animation: fadeInUp 0.6s ease-out forwards; }
        .animate-bounce-in { animation: bounceIn 0.8s ease-out forwards; }
        .animate-number-grow { animation: numberGrow 0.7s ease-out forwards; }

        /* Animation delays */
        .animation-delay-100 { animation-delay: 0.1s; }
        .animation-delay-200 { animation-delay: 0.2s; }
        .animation-delay-300 { animation-delay: 0.3s; }
        .animation-delay-400 { animation-delay: 0.4s; }
        .animation-delay-500 { animation-delay: 0.5s; }
    </style>
</x-app-layout>
