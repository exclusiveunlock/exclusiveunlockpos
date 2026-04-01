<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header with subtle animation -->
            <div class="text-center mb-12 animate-fade-in-down">
                <h1 class="text-5xl font-extrabold text-gray-900 dark:text-white mb-4 leading-tight">
                    Security <span class="gradient-text">Settings</span>
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    Manage your account security, including two-factor authentication, PIN, and device limits.
                </p>
            </div>

            <!-- Settings Tabs with fade-in animation -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 animate-fade-in-up animation-delay-400">
                <!-- Sidebar Navigation -->
                <div class="lg:col-span-1">
                    <nav class="space-y-3" x-data="{ activeTab: 'two-factor' }">
                        <button @click="activeTab = 'two-factor'" 
                                :class="activeTab === 'two-factor' ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 border-blue-200 dark:border-blue-800 shadow-md' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-700 hover:border-blue-300 dark:hover:border-blue-700'"
                                class="w-full text-left px-5 py-3 rounded-xl border transition-all duration-300 flex items-center space-x-3 transform hover:-translate-y-0.5">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            <span>Two-Factor Authentication</span>
                        </button>
                        <button @click="activeTab = 'pin-management'" 
                                :class="activeTab === 'pin-management' ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 border-blue-200 dark:border-blue-800 shadow-md' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-700 hover:border-blue-300 dark:hover:border-blue-700'"
                                class="w-full text-left px-5 py-3 rounded-xl border transition-all duration-300 flex items-center space-x-3 transform hover:-translate-y-0.5">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                            </svg>
                            <span>PIN Management</span>
                        </button>
                        </nav>
                </div>

                <!-- Content Area with slide-in animation -->
                <div class="lg:col-span-3">
                    <!-- Two-Factor Authentication Tab -->
                    <div x-show="activeTab === 'two-factor'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" class="card animate-fade-in">
                        <div class="card-body">
                            <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">Two-Factor Authentication</h3>
                            @include('security.partials.enable-two-factor-authentication-form')
                        </div>
                    </div>

                    <!-- PIN Management Tab -->
                    <div x-show="activeTab === 'pin-management'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" class="card animate-fade-in">
                        <div class="card-body">
                            <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">PIN Management</h3>
                            <!-- PIN Status -->
                            <div class="mb-8">
                                @if (Auth::user()->pin)
                                    <div class="flex items-center space-x-3 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl">
                                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-green-800 dark:text-green-300">PIN is Active</h4>
                                            <p class="text-sm text-green-700 dark:text-green-400">You have successfully set up a PIN for quick login</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex items-center space-x-3 p-4 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-xl">
                                        <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-yellow-800 dark:text-yellow-300">No PIN Set</h4>
                                            <p class="text-sm text-yellow-700 dark:text-yellow-400">Set up a PIN for faster and more convenient login</p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- PIN Form -->
                            @if (Auth::user()->pin)
                                <!-- Update/Disable PIN Form -->
                                <form method="POST" action="{{ route('security.update-pin') }}" class="space-y-6">
                                    @csrf
                                    @method('PUT')

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div class="space-y-2">
                                            <label for="current_pin" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                                Current PIN
                                            </label>
                                            <input 
                                                id="current_pin" 
                                                type="password" 
                                                name="current_pin" 
                                                required 
                                                autofocus 
                                                maxlength="4"
                                                class="form-input-enhanced text-center text-lg tracking-widest"
                                                placeholder="••••"
                                            >
                                            @error('current_pin')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="space-y-2">
                                            <label for="pin" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                                New PIN (optional)
                                            </label>
                                            <input 
                                                id="pin" 
                                                type="password" 
                                                name="pin" 
                                                maxlength="4"
                                                class="form-input-enhanced text-center text-lg tracking-widest"
                                                placeholder="••••"
                                            >
                                            @error('pin')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="space-y-2 md:col-span-2">
                                            <label for="pin_confirmation" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                                Confirm New PIN
                                            </label>
                                            <input 
                                                id="pin_confirmation" 
                                                type="password" 
                                                name="pin_confirmation" 
                                                maxlength="4"
                                                class="form-input-enhanced text-center text-lg tracking-widest max-w-xs"
                                                placeholder="••••"
                                            >
                                            @error('pin_confirmation')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                                        <button 
                                            type="submit" 
                                            class="flex-1 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 btn-animated"
                                        >
                                            Update PIN
                                        </button>
                                        <button 
                                            type="submit" 
                                            name="disable_pin" 
                                            value="1"
                                            class="flex-1 bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 btn-animated"
                                            onclick="return confirm('Are you sure you want to disable your PIN?')"
                                        >
                                            Disable PIN
                                        </button>
                                    </div>
                                </form>
                            @else
                                <!-- Set New PIN Form -->
                                <form method="POST" action="{{ route('security.update-pin') }}" class="space-y-6">
                                    @csrf
                                    @method('PUT')

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div class="space-y-2">
                                            <label for="pin" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                                New PIN
                                            </label>
                                            <input 
                                                id="pin" 
                                                type="password" 
                                                name="pin" 
                                                required 
                                                autofocus 
                                                maxlength="4"
                                                class="form-input-enhanced text-center text-lg tracking-widest"
                                                placeholder="••••"
                                            >
                                            @error('pin')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="space-y-2">
                                            <label for="pin_confirmation" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                                Confirm PIN
                                            </label>
                                            <input 
                                                id="pin_confirmation" 
                                                type="password" 
                                                name="pin_confirmation" 
                                                required 
                                                maxlength="4"
                                                class="form-input-enhanced text-center text-lg tracking-widest"
                                                placeholder="••••"
                                            >
                                            @error('pin_confirmation')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4">
                                        <div class="flex items-start">
                                            <svg class="w-5 h-5 text-blue-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                            </svg>
                                            <div>
                                                <h4 class="text-sm font-semibold text-blue-800 dark:text-blue-300 mb-1">PIN Requirements</h4>
                                                <ul class="text-sm text-blue-700 dark:text-blue-400 space-y-1">
                                                    <li>• Must be exactly 4 digits</li>
                                                    <li>• Use numbers only (0-9)</li>
                                                    <li>• Choose a PIN that's easy to remember but hard to guess</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <button 
                                        type="submit" 
                                        class="w-full bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold py-4 px-6 rounded-xl transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl btn-animated"
                                    >
                                        <div class="flex items-center justify-center space-x-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                            </svg>
                                            <span>Set PIN</span>
                                        </div>
                                    </button>
                                </form>
                            @endif
                        </div>
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
            to { opacity: 1; transform: translateY(0); }\
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

    @push('scripts')
    <script>
        // Auto-format PIN inputs
        document.querySelectorAll('input[type="password"][maxlength="4"]').forEach(input => {
            input.addEventListener('input', function(e) {
                // Only allow numbers
                this.value = this.value.replace(/[^0-9]/g, '');
                
                // Auto-focus next field when 4 digits entered
                if (this.value.length === 4) {
                    const nextInput = this.closest('form').querySelector('input[type="password"]:not([value])');
                    if (nextInput && nextInput !== this) {
                        nextInput.focus();
                    }
                }
            });
            
            input.addEventListener('keydown', function(e) {
                // Allow backspace, delete, tab, escape, enter
                if ([8, 9, 27, 13, 46].indexOf(e.keyCode) !== -1 ||
                    // Allow Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
                    (e.keyCode === 65 && e.ctrlKey === true) ||
                    (e.keyCode === 67 && e.ctrlKey === true) ||
                    (e.keyCode === 86 && e.ctrlKey === true) ||
                    (e.keyCode === 88 && e.ctrlKey === true)) {
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
        });
    </script>
    @endpush
</x-app-layout>