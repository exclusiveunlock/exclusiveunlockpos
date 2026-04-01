<x-app-layout>
    {{-- Main wrapper with enhanced gradient background --}}
    <div class="min-h-screen bg-gradient-to-br from-white via-slate-50 to-blue-50 dark:from-gray-900 dark:via-slate-900 dark:to-gray-800 text-gray-900 dark:text-gray-100">

        {{-- =================================== --}}
        {{-- Clean Header Section (Upgraded)     --}}
        {{-- =================================== --}}
        <div class="bg-white/90 dark:bg-gray-900/80 backdrop-blur-lg border-b border-gray-200/50 dark:border-gray-700/50 sticky top-0 z-50 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">

                    {{-- Logo & Brand Name --}}
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <span class="font-bold text-xl text-gray-900 dark:text-white hidden sm:inline">FirmwareHub</span>
                    </div>

                    {{-- Navigation Links --}}
                    <nav class="hidden md:flex space-x-8">
                        <a href="#" class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Home</a>
                        <a href="#folders" class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Categories</a>
                        <a href="#recent-files" class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Recent Files</a>
                    </nav>

                    {{-- Quick Stats & Auth --}}
                    <div class="flex items-center space-x-4">
                        <div class="hidden lg:flex items-center space-x-6 text-sm text-gray-600 dark:text-gray-400">
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                                <span>{{ number_format($recentFirmware->count() + 9990) }}+ Files</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                                <span>50K+ Downloads</span>
                            </div>
                        </div>
                         <div class="hidden sm:flex items-center space-x-2">
                            <a href="#" class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Log in</a>
                            <a href="#" class="px-5 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-all duration-300 shadow-sm hover:shadow-md">
                                Sign up
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- =================================== --}}
        {{-- Hero Section (Upgraded)             --}}
        {{-- =================================== --}}
        <section class="relative py-20 lg:py-32 overflow-hidden">
            {{-- Background decorative glow --}}
            <div class="absolute inset-x-0 top-0 -z-10 transform-gpu overflow-hidden blur-3xl" aria-hidden="true">
                <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#80caff] to-[#4f46e5] opacity-20 dark:opacity-10 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-4xl mx-auto">
                    <h2 class="text-4xl lg:text-6xl font-extrabold text-gray-900 dark:text-white mb-6 leading-tight tracking-tight">
                        Professional <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Firmware</span> Hub
                    </h2>
                    <p class="text-xl text-gray-600 dark:text-gray-400 mb-10 leading-relaxed">
                        Access the latest firmware updates with enterprise-grade security and reliability.
                    </p>

                    {{-- Clean Search Bar --}}
                    <div class="max-w-2xl mx-auto mb-12">
                        <form method="GET" action="{{ route('home') }}" class="relative group">
                            <div class="relative">
                                <input type="text"
                                       name="search"
                                       value="{{ request('search') }}"
                                       placeholder="Search firmware files by model, brand, or type..."
                                       class="w-full px-6 py-4 pl-14 text-lg bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm border border-gray-200/50 dark:border-slate-700/50 rounded-2xl shadow-lg shadow-blue-500/5 dark:shadow-black/10 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 placeholder-gray-400 dark:placeholder-gray-500">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-6 w-6 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <button type="submit" class="absolute inset-y-0 right-2 top-2 bottom-2 flex items-center">
                                    <div class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-xl transition-all duration-300 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800">
                                        Search
                                    </div>
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <a href="#recent-files" class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all duration-300 hover:scale-105 hover:shadow-lg transform">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Browse Recent Files
                        </a>
                        <a href="#folders" class="inline-flex items-center justify-center px-8 py-3 bg-white/80 dark:bg-slate-800/80 text-gray-900 dark:text-white font-semibold rounded-xl border border-gray-200/50 dark:border-slate-700/50 hover:bg-white dark:hover:bg-slate-800 transition-all duration-300 hover:scale-105 hover:shadow-lg backdrop-blur-sm transform">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                            </svg>
                            Browse Folders
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- =================================== --}}
        {{-- Clean Stats Section (Upgraded)      --}}
        {{-- =================================== --}}
        <section class="py-16 bg-slate-50 dark:bg-slate-800/60 border-y border-slate-200 dark:border-slate-700/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="text-center group">
                        <div class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-2 group-hover:scale-110 transition-transform duration-300">{{ number_format($recentFirmware->count() + 9990) }}+</div>
                        <div class="text-base text-gray-600 dark:text-gray-400 font-medium">Firmware Files</div>
                    </div>
                    <div class="text-center group">
                        <div class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-green-600 to-blue-600 bg-clip-text text-transparent mb-2 group-hover:scale-110 transition-transform duration-300">50,000+</div>
                        <div class="text-base text-gray-600 dark:text-gray-400 font-medium">Downloads</div>
                    </div>
                    <div class="text-center group">
                        <div class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent mb-2 group-hover:scale-110 transition-transform duration-300">5,000+</div>
                        <div class="text-base text-gray-600 dark:text-gray-400 font-medium">Active Users</div>
                    </div>
                    <div class="text-center group">
                        <div class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent mb-2 group-hover:scale-110 transition-transform duration-300">99.9%</div>
                        <div class="text-base text-gray-600 dark:text-gray-400 font-medium">Uptime</div>
                    </div>
                </div>
            </div>
        </section>

        {{-- =================================== --}}
        {{-- Clean Folders Section (Upgraded)    --}}
        {{-- =================================== --}}
        @if(isset($folders) && $folders->count() > 0)
        <section id="folders" class="py-20 lg:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h3 class="text-3xl lg:text-4xl font-extrabold text-gray-900 dark:text-white mb-4 tracking-tight">Browse by Category</h3>
                    <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">Explore firmware files organized by device manufacturer for easy access.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($folders as $folder)
                        <div class="group cursor-pointer" onclick="window.location.href='{{ route('folders.show', $folder) }}'">
                            <div class="relative bg-white dark:bg-slate-800 rounded-2xl p-6 ring-1 ring-slate-200 dark:ring-slate-700 shadow-md hover:shadow-xl dark:shadow-black/10 transition-all duration-300 hover:scale-[1.03] h-full flex flex-col">

                                @if($folder->created_at->diffInHours(now()) < 24)
                                    <span class="absolute top-0 right-0 -mt-2 -mr-2 inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-rose-500 to-red-600 text-white shadow-lg">
                                        New
                                    </span>
                                @endif

                                <div class="text-center flex-grow">
                                    <div class="mb-4">
                                        @if ($folder->icon_path)
                                            <img src="{{ asset('storage/' . $folder->icon_path) }}"
                                                 alt="{{ $folder->name }} icon"
                                                 class="w-16 h-16 mx-auto rounded-lg object-contain group-hover:scale-110 transition-transform duration-300">
                                        @else
                                            <div class="w-16 h-16 mx-auto bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg">
                                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">{{ $folder->name }}</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6 line-clamp-2">{{ $folder->description ?? 'Firmware files for ' . $folder->name }}</p>
                                </div>

                                <div class="mt-auto text-center">
                                    <div class="inline-flex items-center text-sm font-medium text-blue-600 dark:text-blue-400 group-hover:text-blue-700 dark:group-hover:text-blue-300 transition-colors duration-300">
                                        Explore Files
                                        <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        {{-- =================================== --}}
        {{-- Clean Recent Files Section (Upgraded) --}}
        {{-- =================================== --}}
        <section id="recent-files" class="py-20 lg:py-24 bg-white dark:bg-slate-900/70">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h3 class="text-3xl lg:text-4xl font-extrabold text-gray-900 dark:text-white mb-4 tracking-tight">
                        Recently <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Added Files</span>
                    </h3>
                    <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                        Stay up-to-date with the latest firmware releases from our community.
                    </p>
                </div>

                @if($recentFirmware->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($recentFirmware as $index => $firmware)
                            <div class="group">
                                <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 ring-1 ring-slate-200 dark:ring-slate-700 shadow-md hover:shadow-xl dark:shadow-black/10 transition-all duration-300 hover:scale-[1.03] h-full flex flex-col">

                                    <div class="flex items-start justify-between mb-4">
                                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 flex-shrink-0 shadow-lg">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </div>

                                        @if($firmware->created_at->diffInHours(now()) < 24 || $index < 3)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-rose-100 dark:bg-rose-900/30 text-rose-800 dark:text-rose-300 ring-1 ring-inset ring-rose-200 dark:ring-rose-700/50">
                                                <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                                </svg>
                                                New
                                            </span>
                                        @elseif($firmware->downloads_count > 100)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300 ring-1 ring-inset ring-emerald-200 dark:ring-emerald-700/50">
                                                <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                                </svg>
                                                Popular
                                            </span>
                                        @endif
                                    </div>

                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300 line-clamp-2 flex-grow">{{ \Illuminate\Support\Str::words($firmware->name, 7, '...') }}</h4>

                                    <div class="flex items-center justify-between text-sm text-gray-600 dark:text-gray-400 my-4">
                                        <span class="font-medium">{{ $firmware->formatted_size ?? $firmware->size }}</span>
                                        <span>{{ $firmware->downloads_count }} downloads</span>
                                    </div>

                                    <div class="flex items-center justify-between mt-auto">
                                        <span class="text-xs text-gray-500 dark:text-gray-500">{{ $firmware->created_at->diffForHumans() }}</span>
                                        <a href="{{ route('firmware.show', $firmware) }}" class="inline-flex items-center text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors duration-300">
                                            View Details
                                            <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-16 bg-slate-50 dark:bg-slate-800/60 rounded-2xl border border-slate-200 dark:border-slate-700/50">
                        <div class="w-16 h-16 bg-white dark:bg-slate-800 ring-1 ring-slate-200 dark:ring-slate-700 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">No Recent Files Found</h4>
                        <p class="text-gray-600 dark:text-gray-400">Check back soon for new firmware releases.</p>
                    </div>
                @endif
            </div>
        </section>

        {{-- =================================== --}}
        {{-- Clean Footer (Upgraded)             --}}
        {{-- =================================== --}}
        <footer class="py-16 bg-slate-50 dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
                    {{-- Brand --}}
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <span class="font-bold text-xl text-gray-900 dark:text-white">FirmwareHub</span>
                    </div>

                    {{-- Links --}}
                    <div class="flex items-center space-x-6 text-sm font-medium text-gray-600 dark:text-gray-400">
                        <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Terms of Service</a>
                        <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Privacy Policy</a>
                        <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Contact</a>
                    </div>
                </div>

                {{-- Copyright --}}
                <div class="mt-8 pt-8 border-t border-slate-200 dark:border-slate-700/50 text-center">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        © {{ date('Y') }} FirmwareHub. All rights reserved. Professional firmware solutions with enterprise-grade security.
                    </p>
                </div>
            </div>
        </footer>
    </div>
</x-app-layout>
