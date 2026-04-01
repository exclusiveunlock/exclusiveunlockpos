<x-app-layout>
    <x-slot name="title">
        @php
            $path = [];
            $currentFolder = $folder;
            while ($currentFolder) {
                $path[] = $currentFolder->name;
                $currentFolder = $currentFolder->parent;
            }
            echo implode(' > ', array_reverse($path));
        @endphp
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50 dark:from-gray-900 dark:via-gray-800 dark:to-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
            <!-- Enhanced Breadcrumb Navigation with Mobile Support -->
            <nav class="flex mb-6 sm:mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3 flex-wrap">
                    <li class="inline-flex items-center">
                        <a href="/" class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400 transition-colors duration-200 bg-white/80 dark:bg-gray-800/80 px-3 py-2 rounded-lg backdrop-blur-sm shadow-sm hover:shadow-md">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            <span class="hidden sm:inline">Home</span>
                        </a>
                    </li>
                    @php
                        $breadcrumbPath = [];
                        $currentFolder = $folder;
                        while ($currentFolder) {
                            $breadcrumbPath[] = $currentFolder;
                            $currentFolder = $currentFolder->parent;
                        }
                        $breadcrumbPath = array_reverse($breadcrumbPath);
                    @endphp
                    @foreach($breadcrumbPath as $index => $breadcrumbFolder)
                        <li class="flex items-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            @if($index === count($breadcrumbPath) - 1)
                                <span class="text-sm font-medium text-gray-900 dark:text-white bg-blue-50 dark:bg-blue-900/30 px-3 py-2 rounded-lg">{{ Str::limit($breadcrumbFolder->name, 20) }}</span>
                            @else
                                <a href="{{ route('folders.show', $breadcrumbFolder) }}" class="text-sm font-medium text-gray-600 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400 transition-colors duration-200 bg-white/80 dark:bg-gray-800/80 px-3 py-2 rounded-lg backdrop-blur-sm shadow-sm hover:shadow-md">{{ Str::limit($breadcrumbFolder->name, 20) }}</a>
                            @endif
                        </li>
                    @endforeach
                </ol>
            </nav>

            <!-- Enhanced Folder Header -->
            <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-lg rounded-2xl shadow-xl border border-gray-200/50 dark:border-gray-700/50 p-6 sm:p-8 mb-8">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between space-y-4 sm:space-y-0">
                    <div class="flex items-center space-x-4">
                        @if ($folder->icon_path)
                            <img src="{{ asset('storage/' . $folder->icon_path) }}"
                                 alt="{{ $folder->name }} icon"
                                 class="w-16 h-16 sm:w-20 sm:h-20 rounded-xl shadow-lg">
                        @else
                            <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-blue-500 via-purple-600 to-pink-500 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                                </svg>
                            </div>
                        @endif
                        <div>
                            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-2">{{ $folder->name }}</h1>
                            @if($folder->description)
                                <p class="text-base sm:text-lg text-gray-600 dark:text-gray-400 leading-relaxed">{{ $folder->description }}</p>
                            @else
                                <p class="text-base sm:text-lg text-gray-600 dark:text-gray-400">Firmware files for {{ $folder->name }}</p>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Folder Stats -->
                    <div class="flex flex-wrap gap-3 sm:gap-4">
                        <div class="bg-blue-50 dark:bg-blue-900/30 px-4 py-2 rounded-lg border border-blue-200 dark:border-blue-700/50">
                            <div class="text-lg sm:text-xl font-bold text-blue-600 dark:text-blue-400">{{ $subfolders->count() + $firmwareFiles->count() }}</div>
                            <div class="text-xs text-blue-600/70 dark:text-blue-400/70">Total Items</div>
                        </div>
                        @if($firmwareFiles->count() > 0)
                            <div class="bg-green-50 dark:bg-green-900/30 px-4 py-2 rounded-lg border border-green-200 dark:border-green-700/50">
                                <div class="text-lg sm:text-xl font-bold text-green-600 dark:text-green-400">{{ $firmwareFiles->count() }}</div>
                                <div class="text-xs text-green-600/70 dark:text-green-400/70">Files</div>
                            </div>
                        @endif
                        @if($subfolders->count() > 0)
                            <div class="bg-purple-50 dark:bg-purple-900/30 px-4 py-2 rounded-lg border border-purple-200 dark:border-purple-700/50">
                                <div class="text-lg sm:text-xl font-bold text-purple-600 dark:text-purple-400">{{ $subfolders->count() }}</div>
                                <div class="text-xs text-purple-600/70 dark:text-purple-400/70">Folders</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Enhanced Search and Filter Section -->
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl shadow-lg border border-gray-200/50 dark:border-gray-700/50 p-4 sm:p-6 mb-8">
                <form method="GET" action="{{ route('folders.show', $folder) }}" class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1 relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Search in {{ $folder->name }}..." 
                               class="w-full pl-12 pr-4 py-3 text-base bg-white/90 dark:bg-gray-700/90 border border-gray-200/50 dark:border-gray-600/50 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-300">
                    </div>
                    <button type="submit" 
                            class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold rounded-lg transition-all duration-200 hover:scale-105 shadow-lg">
                        <span class="hidden sm:inline">Search</span>
                        <svg class="w-5 h-5 sm:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Content Grid with Enhanced Mobile Layout -->
            <div class="space-y-8">
                <!-- Subfolders Section -->
                @if($subfolders->count() > 0)
                    <section>
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                                <svg class="w-6 h-6 mr-3 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                                </svg>
                                Subfolders
                                <span class="ml-3 text-sm bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 px-2 py-1 rounded-full">{{ $subfolders->count() }}</span>
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">
                            @foreach ($subfolders as $subfolder)
                                <div class="group bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm rounded-xl shadow-lg border border-gray-200/50 dark:border-gray-700/50 hover:shadow-xl transition-all duration-300 hover:scale-[1.02] cursor-pointer" 
                                     onclick="window.location.href='{{ route('folders.show', $subfolder) }}'">
                                    <div class="p-6 text-center">
                                        <div class="mb-4">
                                            @if ($subfolder->icon_path)
                                                <img src="{{ asset('storage/' . $subfolder->icon_path) }}"
                                                     alt="{{ $subfolder->name }} icon"
                                                     class="w-16 h-16 mx-auto rounded-lg shadow-md group-hover:scale-110 transition-transform duration-200">
                                            @else
                                                <div class="w-16 h-16 mx-auto bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-200">
                                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors duration-200">
                                            {{ Str::limit($subfolder->name, 25) }}
                                        </h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                                            {{ $subfolder->description ?? 'Firmware files for ' . $subfolder->name }}
                                        </p>
                                        <div class="inline-flex items-center px-4 py-2 bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 rounded-lg text-sm font-medium group-hover:bg-purple-200 dark:group-hover:bg-purple-900/50 transition-colors duration-200">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                            Explore
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif

                <!-- Firmware Files Section -->
                @if($firmwareFiles->count() > 0)
                    <section>
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                                <svg class="w-6 h-6 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Firmware Files
                                <span class="ml-3 text-sm bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 px-2 py-1 rounded-full">{{ $firmwareFiles->count() }}</span>
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                            @foreach ($firmwareFiles as $firmware)
                                <div class="group bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm rounded-xl shadow-lg border border-gray-200/50 dark:border-gray-700/50 hover:shadow-xl transition-all duration-300 hover:scale-[1.01]">
                                    <div class="p-6">
                                        <div class="flex items-start justify-between mb-4">
                                            <div class="flex items-center space-x-4">
                                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center shadow-md group-hover:scale-110 transition-transform duration-200">
                                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 2 01-2 2z"></path>
                                                    </svg>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200 truncate">
                                                        {{ $firmware->name }}
                                                    </h3>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                                        {{ $firmware->description ?? 'Firmware file' }}
                                                    </p>
                                                </div>
                                            </div>
                                            
                                            @if($firmware->created_at->diffInHours(now()) < 24)
                                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300 rounded-full border border-red-200 dark:border-red-700/50">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                                    </svg>
                                                    New
                                                </span>
                                            @endif
                                        </div>

                                        <div class="flex flex-wrap items-center justify-between gap-3">
                                            <div class="flex flex-wrap items-center gap-3 text-sm text-gray-500 dark:text-gray-400">
                                                @if($firmware->file_size)
                                                    <span class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                        </svg>
                                                        {{ $firmware->formatted_file_size }}
                                                    </span>
                                                @endif
                                                <span class="flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    {{ $firmware->created_at->diffForHumans() }}
                                                </span>
                                            </div>

                                            <a href="{{ route('firmware.show', $firmware) }}" 
                                               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white text-sm font-semibold rounded-lg transition-all duration-200 hover:scale-105 shadow-md">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @if($firmwareFiles->hasPages())
                            <div class="mt-8">
                                {{ $firmwareFiles->appends(request()->query())->links() }}
                            </div>
                        @endif
                    </section>
                @endif

                <!-- Empty State -->
                @if($subfolders->count() === 0 && $firmwareFiles->count() === 0)
                    <div class="text-center py-16">
                        <div class="w-24 h-24 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">This folder is empty</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">No files or subfolders found in {{ $folder->name }}</p>
                        <a href="/" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold rounded-lg transition-all duration-200 hover:scale-105 shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                            </svg>
                            Browse Other Folders
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

