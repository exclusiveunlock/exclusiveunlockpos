<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                </svg>
            </div>
            <h2 class="font-bold text-2xl text-gray-900 dark:text-white">
                {{ __('API Settings') }}
            </h2>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-purple-50 via-white to-indigo-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="text-center mb-8 animate-fade-in-down">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-4 animate-pulse-slow">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Dhru Fusion API Settings</h1>
                <p class="text-gray-600 dark:text-gray-400 text-lg">Manage your API access and security settings</p>
            </div>

            <!-- Alert Messages -->
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 rounded-xl animate-slide-in-left">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 rounded-xl animate-slide-in-left">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            <div class="space-y-8">
                <!-- API Key Section -->
                <div class="card-enhanced hover-lift animate-fade-in-up">
                    <div class="p-8">
                        <div class="flex items-center space-x-4 mb-6">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">API Key Management</h3>
                                <p class="text-gray-600 dark:text-gray-400">Generate and manage your API access key</p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    Your API Key
                                </label>
                                <div class="flex items-center space-x-3">
                                    <div class="flex-1 relative">
                                        <input 
                                            type="text" 
                                            value="{{ $user->dhru_fusion_api_key ?? 'Not Generated' }}" 
                                            readonly 
                                            class="form-input-enhanced pr-12 font-mono text-sm"
                                            id="api-key-input"
                                        >
                                        @if($user->dhru_fusion_api_key)
                                            <button 
                                                onclick="copyToClipboard('api-key-input')"
                                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors duration-200"
                                                title="Copy to clipboard"
                                            >
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                    <form action="{{ route('user.api-settings.generate-key') }}" method="POST">
                                        @csrf
                                        <button 
                                            type="submit" 
                                            class="bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 btn-animated"
                                            onclick="return confirm('{{ $user->dhru_fusion_api_key ? 'This will replace your existing API key. Continue?' : 'Generate a new API key?' }}')"
                                        >
                                            <div class="flex items-center space-x-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                                </svg>
                                                <span>{{ $user->dhru_fusion_api_key ? 'Regenerate' : 'Generate' }} Key</span>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                                @if(!$user->dhru_fusion_api_key)
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Generate an API key to start using the Dhru Fusion API</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- API Access Status -->
                <div class="card-enhanced hover-lift animate-fade-in-up">
                    <div class="p-8">
                        <div class="flex items-center space-x-4 mb-6">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-teal-600 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">API Access Control</h3>
                                <p class="text-gray-600 dark:text-gray-400">Enable or disable API access for your account</p>
                            </div>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-800/50 rounded-xl p-6">
                            <form action="{{ route('user.api-settings.toggle-access') }}" method="POST">
                                @csrf
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">API Status</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            {{ $user->dhru_fusion_api_enabled ? 'API access is currently enabled' : 'API access is currently disabled' }}
                                        </p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input 
                                            type="checkbox" 
                                            name="api_enabled" 
                                            class="sr-only peer" 
                                            onchange="this.form.submit()" 
                                            {{ $user->dhru_fusion_api_enabled ? 'checked' : '' }}
                                        >
                                        <div class="relative w-14 h-8 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border after:border-gray-300 after:rounded-full after:h-7 after:w-7 after:transition-all dark:border-gray-600 peer-checked:bg-gradient-to-r peer-checked:from-green-500 peer-checked:to-emerald-600"></div>
                                        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                                            {{ $user->dhru_fusion_api_enabled ? 'Enabled' : 'Disabled' }}
                                        </span>
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- IP Whitelist Section -->
                <div class="card-enhanced hover-lift animate-fade-in-up">
                    <div class="p-8">
                        <div class="flex items-center space-x-4 mb-6">
                            <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-pink-600 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">IP Address Whitelist</h3>
                                <p class="text-gray-600 dark:text-gray-400">Restrict API access to specific IP addresses</p>
                            </div>
                        </div>

                        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4 mb-6">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-blue-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    <h4 class="text-sm font-semibold text-blue-800 dark:text-blue-300 mb-1">Security Notice</h4>
                                    <p class="text-sm text-blue-700 dark:text-blue-400">
                                        Add IP addresses that are allowed to use your API key. Leave empty to allow access from any IP address.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('user.api-settings.update-ips') }}" method="POST" class="space-y-6">
                            @csrf
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    Allowed IP Addresses
                                </label>
                                <div id="ip-addresses-container" class="space-y-3">
                                    @php
                                        $ips = is_array($user->dhru_fusion_allowed_ips)
                                            ? $user->dhru_fusion_allowed_ips
                                            : (is_string($user->dhru_fusion_allowed_ips)
                                                ? explode(',', $user->dhru_fusion_allowed_ips)
                                                : []);
                                    @endphp

                                    @forelse ($ips as $ip)
                                        <div class="flex items-center space-x-3 ip-field-group">
                                            <div class="flex-1">
                                                <input 
                                                    type="text" 
                                                    name="dhru_fusion_allowed_ips[]" 
                                                    value="{{ trim($ip) }}" 
                                                    class="form-input-enhanced"
                                                    placeholder="e.g., 192.168.1.1 or 203.0.113.0/24"
                                                >
                                            </div>
                                            <button 
                                                type="button" 
                                                class="remove-ip-button bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 hover:bg-red-200 dark:hover:bg-red-900/50 p-2 rounded-lg transition-colors duration-200"
                                                title="Remove IP address"
                                            >
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    @empty
                                        <div class="flex items-center space-x-3 ip-field-group">
                                            <div class="flex-1">
                                                <input 
                                                    type="text" 
                                                    name="dhru_fusion_allowed_ips[]" 
                                                    class="form-input-enhanced" 
                                                    placeholder="e.g., 192.168.1.1 or 203.0.113.0/24"
                                                >
                                            </div>
                                            <button 
                                                type="button" 
                                                class="remove-ip-button bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 hover:bg-red-200 dark:hover:bg-red-900/50 p-2 rounded-lg transition-colors duration-200"
                                                title="Remove IP address"
                                                style="display: none;"
                                            >
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    @endforelse
                                </div>
                                
                                <div class="flex items-center space-x-4 mt-4">
                                    <button 
                                        type="button" 
                                        id="add-ip-button" 
                                        class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-medium py-2 px-4 rounded-lg transition-colors duration-200"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                            <span>Add IP Address</span>
                                        </div>
                                    </button>
                                </div>
                            </div>

                            <div class="pt-4">
                                <button 
                                    type="submit" 
                                    class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-semibold py-3 px-8 rounded-xl transition-all duration-300 btn-animated"
                                >
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span>Save IP Addresses</span>
                                    </div>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- API Documentation -->
                <div class="card-enhanced animate-fade-in-up">
                    <div class="p-8">
                        <div class="flex items-center space-x-4 mb-6">
                            <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">API Documentation</h3>
                                <p class="text-gray-600 dark:text-gray-400">Learn how to integrate with our API</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <a href="#" class="bg-gray-50 dark:bg-gray-800/50 rounded-xl p-6 hover:bg-gray-100 dark:hover:bg-gray-700/50 transition-colors duration-200 group">
                                <div class="flex items-center space-x-3 mb-3">
                                    <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <h4 class="font-semibold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                                        API Reference
                                    </h4>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Complete API documentation with endpoints and examples</p>
                            </a>

                            <a href="#" class="bg-gray-50 dark:bg-gray-800/50 rounded-xl p-6 hover:bg-gray-100 dark:hover:bg-gray-700/50 transition-colors duration-200 group">
                                <div class="flex items-center space-x-3 mb-3">
                                    <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                                        </svg>
                                    </div>
                                    <h4 class="font-semibold text-gray-900 dark:text-white group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-200">
                                        Code Examples
                                    </h4>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Sample code in multiple programming languages</p>
                            </a>

                            <a href="#" class="bg-gray-50 dark:bg-gray-800/50 rounded-xl p-6 hover:bg-gray-100 dark:hover:bg-gray-700/50 transition-colors duration-200 group">
                                <div class="flex items-center space-x-3 mb-3">
                                    <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <h4 class="font-semibold text-gray-900 dark:text-white group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors duration-200">
                                        FAQ & Support
                                    </h4>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Common questions and troubleshooting guides</p>
                            </a>

                            <a href="#" class="bg-gray-50 dark:bg-gray-800/50 rounded-xl p-6 hover:bg-gray-100 dark:hover:bg-gray-700/50 transition-colors duration-200 group">
                                <div class="flex items-center space-x-3 mb-3">
                                    <div class="w-8 h-8 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                    </div>
                                    <h4 class="font-semibold text-gray-900 dark:text-white group-hover:text-orange-600 dark:group-hover:text-orange-400 transition-colors duration-200">
                                        Rate Limits
                                    </h4>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Understanding API rate limits and best practices</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Copy to clipboard functionality
        function copyToClipboard(elementId) {
            const element = document.getElementById(elementId);
            element.select();
            element.setSelectionRange(0, 99999);
            document.execCommand('copy');
            
            // Show feedback
            const button = element.nextElementSibling;
            const originalHTML = button.innerHTML;
            button.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
            button.classList.add('text-green-500');
            
            setTimeout(() => {
                button.innerHTML = originalHTML;
                button.classList.remove('text-green-500');
            }, 2000);
        }

        // IP address management
        document.getElementById('add-ip-button').addEventListener('click', function () {
            const container = document.getElementById('ip-addresses-container');
            const newIpField = document.createElement('div');
            newIpField.className = 'flex items-center space-x-3 ip-field-group';
            newIpField.innerHTML = `
                <div class="flex-1">
                    <input type="text" name="dhru_fusion_allowed_ips[]" class="form-input-enhanced" placeholder="e.g., 192.168.1.1 or 203.0.113.0/24">
                </div>
                <button type="button" class="remove-ip-button bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 hover:bg-red-200 dark:hover:bg-red-900/50 p-2 rounded-lg transition-colors duration-200" title="Remove IP address">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            `;
            container.appendChild(newIpField);

            // Add event listener to the new remove button
            newIpField.querySelector('.remove-ip-button').addEventListener('click', function () {
                newIpField.remove();
                updateRemoveButtons();
            });
            
            updateRemoveButtons();
        });

        // Remove IP address functionality
        function updateRemoveButtons() {
            const ipFields = document.querySelectorAll('.ip-field-group');
            ipFields.forEach((field, index) => {
                const removeButton = field.querySelector('.remove-ip-button');
                if (ipFields.length > 1) {
                    removeButton.style.display = 'block';
                } else {
                    removeButton.style.display = 'none';
                }
            });
        }

        // Initialize remove button event listeners
        document.querySelectorAll('.remove-ip-button').forEach(button => {
            button.addEventListener('click', function () {
                button.closest('.ip-field-group').remove();
                updateRemoveButtons();
            });
        });

        // Initial update of remove buttons
        updateRemoveButtons();
    </script>
    @endpush
</x-app-layout>

