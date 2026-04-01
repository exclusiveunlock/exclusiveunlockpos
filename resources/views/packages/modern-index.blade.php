<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-16">
                <h1 class="text-5xl font-bold text-gray-900 dark:text-white mb-6">
                    Choose Your <span class="gradient-text">Perfect Plan</span>
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
                    Unlock premium features and unlimited downloads with our flexible pricing plans designed for professionals.
                </p>
            </div>

            <!-- Pricing Toggle -->
            <div class="flex justify-center mb-12">
                <div class="bg-white dark:bg-gray-800 p-1 rounded-xl shadow-lg" x-data="{ billing: 'monthly' }">
                    <div class="flex">
                        <button @click="billing = 'monthly'" 
                                :class="billing === 'monthly' ? 'bg-blue-500 text-white shadow-md' : 'text-gray-600 dark:text-gray-400'"
                                class="px-6 py-3 rounded-lg font-medium transition-all duration-200">
                            Monthly
                        </button>
                        <button @click="billing = 'yearly'" 
                                :class="billing === 'yearly' ? 'bg-blue-500 text-white shadow-md' : 'text-gray-600 dark:text-gray-400'"
                                class="px-6 py-3 rounded-lg font-medium transition-all duration-200">
                            Yearly
                            <span class="ml-2 px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Save 20%</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Pricing Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                @foreach ($packages as $index => $package)
                    <div class="relative {{ $index === 1 ? 'transform scale-105' : '' }}">
                        @if ($index === 1)
                            <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                                <span class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-4 py-2 rounded-full text-sm font-medium">
                                    Most Popular
                                </span>
                            </div>
                        @endif
                        
                        <div class="card {{ $index === 1 ? 'border-blue-200 dark:border-blue-800 shadow-xl' : '' }} h-full">
                            <div class="card-body text-center">
                                <!-- Package Header -->
                                <div class="mb-8">
                                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ $package->title }}</h3>
                                    <p class="text-gray-600 dark:text-gray-400">{{ $package->duration }}</p>
                                </div>

                                <!-- Price -->
                                <div class="mb-8">
                                    <div class="flex items-baseline justify-center">
                                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $package->currency->symbol ?? '$' }}</span>
                                        <span class="text-5xl font-bold gradient-text">{{ number_format($package->price, 0) }}</span>
                                        <span class="text-gray-500 dark:text-gray-400 ml-2">/{{ strtolower($package->duration) }}</span>
                                    </div>
                                </div>

                                <!-- Features -->
                                <div class="space-y-4 mb-8">
                                    <div class="flex items-center justify-between py-2 border-b border-gray-100 dark:border-gray-700">
                                        <span class="text-gray-600 dark:text-gray-400">Bandwidth</span>
                                        <span class="font-semibold text-gray-900 dark:text-white">{{ $package->bandwidth }}GB</span>
                                    </div>
                                    <div class="flex items-center justify-between py-2 border-b border-gray-100 dark:border-gray-700">
                                        <span class="text-gray-600 dark:text-gray-400">Total Bandwidth</span>
                                        <span class="font-semibold text-gray-900 dark:text-white">{{ $package->total_bandwidth }}MB</span>
                                    </div>
                                    <div class="flex items-center justify-between py-2 border-b border-gray-100 dark:border-gray-700">
                                        <span class="text-gray-600 dark:text-gray-400">Daily Bandwidth</span>
                                        <span class="font-semibold text-gray-900 dark:text-white">{{ $package->daily_bandwidth }}MB</span>
                                    </div>
                                    <div class="flex items-center justify-between py-2 border-b border-gray-100 dark:border-gray-700">
                                        <span class="text-gray-600 dark:text-gray-400">Files</span>
                                        <span class="font-semibold text-gray-900 dark:text-white">{{ $package->files }}</span>
                                    </div>
                                    <div class="flex items-center justify-between py-2 border-b border-gray-100 dark:border-gray-700">
                                        <span class="text-gray-600 dark:text-gray-400">Daily Files</span>
                                        <span class="font-semibold text-gray-900 dark:text-white">{{ $package->daily_files }}</span>
                                    </div>
                                    <div class="flex items-center justify-between py-2">
                                        <span class="text-gray-600 dark:text-gray-400">Total Files</span>
                                        <span class="font-semibold text-gray-900 dark:text-white">{{ $package->total_files }}</span>
                                    </div>
                                    @if($package->can_access_password_files)
                                    <div class="flex items-center justify-between py-2">
                                        <span class="text-gray-600 dark:text-gray-400">Access Password Protected Files</span>
                                        <span class="font-semibold text-gray-900 dark:text-white">Yes</span>
                                    </div>
                                    @endif
                                </div>

                                <!-- CTA Button -->
                                <form action="{{ route('packages.activate', $package) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            class="{{ $index === 1 ? 'btn-primary' : 'btn-secondary' }} w-full group"
                                            @if(auth()->check() && auth()->user()->balance < $package->price) disabled @endif>
                                        @if(auth()->check() && auth()->user()->balance < $package->price)
                                            Insufficient Funds (Balance: {{ auth()->user()->balance }} {{ $package->currency->code ?? '
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Features Comparison -->
            <div class="card mb-16">
                <div class="card-body">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white text-center mb-8">Compare All Features</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <th class="text-left py-4 px-6 text-gray-900 dark:text-white font-semibold">Features</th>
                                    @foreach ($packages as $package)
                                        <th class="text-center py-4 px-6 text-gray-900 dark:text-white font-semibold">{{ $package->title }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-gray-100 dark:border-gray-800">
                                    <td class="py-4 px-6 text-gray-600 dark:text-gray-400">Bandwidth</td>
                                    @foreach ($packages as $package)
                                        <td class="text-center py-4 px-6 text-gray-900 dark:text-white">{{ $package->bandwidth }}GB</td>
                                    @endforeach
                                </tr>
                                <tr class="border-b border-gray-100 dark:border-gray-800">
                                    <td class="py-4 px-6 text-gray-600 dark:text-gray-400">Daily Downloads</td>
                                    @foreach ($packages as $package)
                                        <td class="text-center py-4 px-6 text-gray-900 dark:text-white">{{ $package->daily_files }}</td>
                                    @endforeach
                                </tr>
                                <tr class="border-b border-gray-100 dark:border-gray-800">
                                    <td class="py-4 px-6 text-gray-600 dark:text-gray-400">Total Downloads</td>
                                    @foreach ($packages as $package)
                                        <td class="text-center py-4 px-6 text-gray-900 dark:text-white">{{ $package->total_files }}</td>
                                    @endforeach
                                </tr>
                                <tr class="border-b border-gray-100 dark:border-gray-800">
                                    <td class="py-4 px-6 text-gray-600 dark:text-gray-400">Priority Support</td>
                                    @foreach ($packages as $index => $package)
                                        <td class="text-center py-4 px-6">
                                            @if ($index >= 1)
                                                <svg class="w-5 h-5 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            @else
                                                <svg class="w-5 h-5 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td class="py-4 px-6 text-gray-600 dark:text-gray-400">API Access</td>
                                    @foreach ($packages as $index => $package)
                                        <td class="text-center py-4 px-6">
                                            @if ($index >= 2)
                                                <svg class="w-5 h-5 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            @else
                                                <svg class="w-5 h-5 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- FAQ Section -->
            <div class="card">
                <div class="card-body">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white text-center mb-8">Frequently Asked Questions</h3>
                    
                    <div class="space-y-6" x-data="{ openFaq: null }">
                        <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                            <button @click="openFaq = openFaq === 1 ? null : 1" 
                                    class="flex justify-between items-center w-full text-left">
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-white">What payment methods do you accept?</h4>
                                <svg :class="openFaq === 1 ? 'rotate-180' : ''" class="w-5 h-5 text-gray-500 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="openFaq === 1" x-transition class="mt-4 text-gray-600 dark:text-gray-400">
                                We accept all major credit cards, PayPal, and bank transfers. All payments are processed securely through our encrypted payment gateway.
                            </div>
                        </div>

                        <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                            <button @click="openFaq = openFaq === 2 ? null : 2" 
                                    class="flex justify-between items-center w-full text-left">
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Can I upgrade or downgrade my plan?</h4>
                                <svg :class="openFaq === 2 ? 'rotate-180' : ''" class="w-5 h-5 text-gray-500 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="openFaq === 2" x-transition class="mt-4 text-gray-600 dark:text-gray-400">
                                Yes, you can upgrade or downgrade your plan at any time. Changes will be prorated and reflected in your next billing cycle.
                            </div>
                        </div>

                        <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                            <button @click="openFaq = openFaq === 3 ? null : 3" 
                                    class="flex justify-between items-center w-full text-left">
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Is there a free trial available?</h4>
                                <svg :class="openFaq === 3 ? 'rotate-180' : ''" class="w-5 h-5 text-gray-500 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="openFaq === 3" x-transition class="mt-4 text-gray-600 dark:text-gray-400">
                                We offer a 7-day free trial for all new users. No credit card required to start your trial.
                            </div>
                        </div>

                        <div>
                            <button @click="openFaq = openFaq === 4 ? null : 4" 
                                    class="flex justify-between items-center w-full text-left">
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-white">What happens if I exceed my limits?</h4>
                                <svg :class="openFaq === 4 ? 'rotate-180' : ''" class="w-5 h-5 text-gray-500 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="openFaq === 4" x-transition class="mt-4 text-gray-600 dark:text-gray-400">
                                If you exceed your plan limits, downloads will be temporarily suspended until the next billing cycle or you can upgrade your plan immediately.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Success/Error Messages -->
            @if (session('success'))
                <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg z-50" x-data="{ show: true }" x-show="show" x-transition>
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>{{ session('success') }}</span>
                        <button @click="show = false" class="ml-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg z-50" x-data="{ show: true }" x-show="show" x-transition>
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <span>{{ session('error') }}</span>
                        <button @click="show = false" class="ml-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

 

            <!-- Features Comparison -->
            <div class="card mb-16">
                <div class="card-body">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white text-center mb-8">Compare All Features</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <th class="text-left py-4 px-6 text-gray-900 dark:text-white font-semibold">Features</th>
                                    @foreach ($packages as $package)
                                        <th class="text-center py-4 px-6 text-gray-900 dark:text-white font-semibold">{{ $package->title }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-gray-100 dark:border-gray-800">
                                    <td class="py-4 px-6 text-gray-600 dark:text-gray-400">Bandwidth</td>
                                    @foreach ($packages as $package)
                                        <td class="text-center py-4 px-6 text-gray-900 dark:text-white">{{ $package->bandwidth }}GB</td>
                                    @endforeach
                                </tr>
                                <tr class="border-b border-gray-100 dark:border-gray-800">
                                    <td class="py-4 px-6 text-gray-600 dark:text-gray-400">Daily Downloads</td>
                                    @foreach ($packages as $package)
                                        <td class="text-center py-4 px-6 text-gray-900 dark:text-white">{{ $package->daily_files }}</td>
                                    @endforeach
                                </tr>
                                <tr class="border-b border-gray-100 dark:border-gray-800">
                                    <td class="py-4 px-6 text-gray-600 dark:text-gray-400">Total Downloads</td>
                                    @foreach ($packages as $package)
                                        <td class="text-center py-4 px-6 text-gray-900 dark:text-white">{{ $package->total_files }}</td>
                                    @endforeach
                                </tr>
                                <tr class="border-b border-gray-100 dark:border-gray-800">
                                    <td class="py-4 px-6 text-gray-600 dark:text-gray-400">Priority Support</td>
                                    @foreach ($packages as $index => $package)
                                        <td class="text-center py-4 px-6">
                                            @if ($index >= 1)
                                                <svg class="w-5 h-5 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            @else
                                                <svg class="w-5 h-5 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td class="py-4 px-6 text-gray-600 dark:text-gray-400">API Access</td>
                                    @foreach ($packages as $index => $package)
                                        <td class="text-center py-4 px-6">
                                            @if ($index >= 2)
                                                <svg class="w-5 h-5 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            @else
                                                <svg class="w-5 h-5 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- FAQ Section -->
            <div class="card">
                <div class="card-body">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white text-center mb-8">Frequently Asked Questions</h3>
                    
                    <div class="space-y-6" x-data="{ openFaq: null }">
                        <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                            <button @click="openFaq = openFaq === 1 ? null : 1" 
                                    class="flex justify-between items-center w-full text-left">
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-white">What payment methods do you accept?</h4>
                                <svg :class="openFaq === 1 ? 'rotate-180' : ''" class="w-5 h-5 text-gray-500 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="openFaq === 1" x-transition class="mt-4 text-gray-600 dark:text-gray-400">
                                We accept all major credit cards, PayPal, and bank transfers. All payments are processed securely through our encrypted payment gateway.
                            </div>
                        </div>

                        <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                            <button @click="openFaq = openFaq === 2 ? null : 2" 
                                    class="flex justify-between items-center w-full text-left">
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Can I upgrade or downgrade my plan?</h4>
                                <svg :class="openFaq === 2 ? 'rotate-180' : ''" class="w-5 h-5 text-gray-500 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="openFaq === 2" x-transition class="mt-4 text-gray-600 dark:text-gray-400">
                                Yes, you can upgrade or downgrade your plan at any time. Changes will be prorated and reflected in your next billing cycle.
                            </div>
                        </div>

                        <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                            <button @click="openFaq = openFaq === 3 ? null : 3" 
                                    class="flex justify-between items-center w-full text-left">
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Is there a free trial available?</h4>
                                <svg :class="openFaq === 3 ? 'rotate-180' : ''" class="w-5 h-5 text-gray-500 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="openFaq === 3" x-transition class="mt-4 text-gray-600 dark:text-gray-400">
                                We offer a 7-day free trial for all new users. No credit card required to start your trial.
                            </div>
                        </div>

                        <div>
                            <button @click="openFaq = openFaq === 4 ? null : 4" 
                                    class="flex justify-between items-center w-full text-left">
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-white">What happens if I exceed my limits?</h4>
                                <svg :class="openFaq === 4 ? 'rotate-180' : ''" class="w-5 h-5 text-gray-500 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="openFaq === 4" x-transition class="mt-4 text-gray-600 dark:text-gray-400">
                                If you exceed your plan limits, downloads will be temporarily suspended until the next billing cycle or you can upgrade your plan immediately.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Success/Error Messages -->
            @if (session('success'))
                <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg z-50" x-data="{ show: true }" x-show="show" x-transition>
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>{{ session('success') }}</span>
                        <button @click="show = false" class="ml-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg z-50" x-data="{ show: true }" x-show="show" x-transition>
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <span>{{ session('error') }}</span>
                        <button @click="show = false" class="ml-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

