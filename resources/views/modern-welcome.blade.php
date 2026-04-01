<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
        <!-- Hero Section -->
        <section class="relative overflow-hidden py-20 px-4">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-5 dark:opacity-10">
                <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                            <path d="M 10 0 L 0 0 0 10" fill="none" stroke="currentColor" stroke-width="0.5"/>
                        </pattern>
                    </defs>
                    <rect width="100" height="100" fill="url(#grid)" />
                </svg>
            </div>

            <div class="max-w-7xl mx-auto text-center relative z-10">
                <div class="animate-fadeInUp">
                    <h1 class="text-5xl md:text-7xl font-bold mb-6">
                        <span class="gradient-text">Download Latest</span><br>
                        <span class="text-gray-900 dark:text-white">GSM Firmware</span><br>
                        <span class="gradient-text">Instantly</span>
                    </h1>
                    <p class="text-xl md:text-2xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto">
                        Trusted by professionals worldwide. Access premium firmware downloads with our secure platform.
                    </p>
                </div>

                <!-- Search Bar -->
                <div class="animate-fadeInUp max-w-2xl mx-auto mb-12" style="animation-delay: 0.2s;">
                    <form action="{{ route('home') }}" method="GET" class="relative">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" 
                                   name="search" 
                                   placeholder="Search for firmware files..." 
                                   value="{{ request('search') }}"
                                   class="w-full pl-12 pr-4 py-4 text-lg rounded-2xl border-2 border-gray-200 dark:border-gray-700 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm focus:border-blue-500 dark:focus:border-blue-400 focus:ring-0 transition-all duration-300 shadow-lg hover:shadow-xl">
                        </div>
                    </form>
                </div>

                <!-- Stats -->
                <div class="animate-fadeInUp grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto" style="animation-delay: 0.4s;">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="text-3xl font-bold gradient-text mb-2">10,000+</div>
                            <div class="text-gray-600 dark:text-gray-400">Firmware Files</div>
                        </div>
                    </div>
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="text-3xl font-bold gradient-text mb-2">50,000+</div>
                            <div class="text-gray-600 dark:text-gray-400">Happy Users</div>
                        </div>
                    </div>
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="text-3xl font-bold gradient-text mb-2">99.9%</div>
                            <div class="text-gray-600 dark:text-gray-400">Uptime</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Browse by Folder Section -->
        @if(isset($folders) && $folders->count() > 0)
        <section class="py-20 px-4">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Browse by Category</h2>
                    <p class="text-xl text-gray-600 dark:text-gray-400">Explore firmware files organized by device manufacturer</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($folders as $folder)
                        <div class="card group cursor-pointer" onclick="window.location.href='{{ route('folders.show', $folder) }}'">
                            <div class="card-body text-center">
                                <div class="mb-4">
                                    @if ($folder->icon_path)
                                        <img src="{{ asset('storage/' . $folder->icon_path) }}" 
                                             alt="{{ $folder->name }} icon" 
                                             class="w-16 h-16 mx-auto rounded-lg">
                                    @else
                                        <div class="w-16 h-16 mx-auto bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ $folder->name }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">{{ $folder->description ?? 'Firmware files for ' . $folder->name }}</p>
                                <div class="btn-primary text-sm group-hover:scale-105 transition-transform duration-200">
                                    Explore Files
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        <!-- Latest Files Section -->
        @if(isset($latestFirmware) && $latestFirmware->count() > 0)
        <section class="py-20 px-4 bg-gray-50 dark:bg-gray-800/50">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Recently Added Files</h2>
                    <p class="text-xl text-gray-600 dark:text-gray-400">Latest firmware files added to our collection</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($latestFirmware->take(10) as $firmware)
                        <div class="card group">
                            <div class="card-body">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-center space-x-3">
                                        @if ($firmware->icon_path)
                                            <img src="{{ asset('storage/' . $firmware->icon_path) }}" 
                                                 alt="{{ $firmware->name }} icon" 
                                                 class="w-10 h-10 rounded-lg">
                                        @else
                                            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-blue-600 rounded-lg flex items-center justify-center">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            @php
                                                $badgeClass = match($firmware->type) {
                                                    'free' => 'badge-free',
                                                    'featured' => 'badge-featured',
                                                    'paid' => 'badge-premium',
                                                    default => 'badge-free'
                                                };
                                            @endphp
                                            <span class="{{ $badgeClass }}">{{ ucfirst($firmware->type) }}</span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $firmware->created_at->format('M d, Y') }}</div>
                                    </div>
                                </div>

                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                                    <a href="{{ route('firmware.show', $firmware) }}">{{ $firmware->name }}</a>
                                </h3>

                                <div class="flex items-center justify-between text-sm text-gray-600 dark:text-gray-400 mb-4">
                                    <span class="flex items-center space-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
                                        </svg>
                                        <span>{{ $firmware->size ?? 'N/A' }}</span>
                                    </span>
                                    <span class="flex items-center space-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <span>{{ $firmware->downloads_count ?? 0 }}</span>
                                    </span>
                                </div>

                                <a href="{{ route('firmware.show', $firmware) }}" 
                                   class="btn-primary w-full text-center text-sm group-hover:scale-105 transition-transform duration-200">
                                    View Details
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-12">
                    <a href="#" class="btn-secondary inline-flex items-center space-x-2">
                        <span>View All Files</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </section>
        @endif



        <!-- CTA Section -->
        <section class="py-20 px-4 bg-gradient-to-r from-blue-600 to-purple-600">
            <div class="max-w-4xl mx-auto text-center text-white">
                <h2 class="text-4xl font-bold mb-4">Ready to Get Started?</h2>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @guest
                        <a href="{{ route('register') }}" class="bg-white text-blue-600 px-8 py-4 rounded-xl font-semibold hover:bg-gray-100 transition-colors duration-200 transform hover:scale-105">
                            Create Free Account
                        </a>
                        <a href="{{ route('login') }}" class="border-2 border-white text-white px-8 py-4 rounded-xl font-semibold hover:bg-white hover:text-blue-600 transition-colors duration-200 transform hover:scale-105">
                            Sign In
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="bg-white text-blue-600 px-8 py-4 rounded-xl font-semibold hover:bg-gray-100 transition-colors duration-200 transform hover:scale-105">
                            Go to Dashboard
                        </a>
                    @endguest
                </div>
            </div>
        </section>
    </div>
</x-app-layout>

