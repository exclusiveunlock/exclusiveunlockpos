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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Clean Breadcrumb Navigation -->
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="/" class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Home
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
                        <li>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                @if($index === count($breadcrumbPath) - 1)
                                    <span class="ml-1 text-sm font-medium text-gray-500 dark:text-gray-400">{{ $breadcrumbFolder->name }}</span>
                                @else
                                    <a href="{{ route('folders.show', $breadcrumbFolder) }}" class="ml-1 text-sm font-medium text-gray-600 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400 transition-colors duration-200">{{ $breadcrumbFolder->name }}</a>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ol>
            </nav>

            <!-- Clean Folder Header -->
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl p-8 border border-gray-200/50 dark:border-gray-700/50 mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="flex items-center space-x-4 mb-4 md:mb-0">
                        @if ($folder->icon_path)
                            <img src="{{ asset('storage/' . $folder->icon_path) }}"
                                 alt="{{ $folder->name }} icon"
                                 class="w-16 h-16 rounded-xl">
                        @else
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                                </svg>
                            </div>
                        @endif
                        
                        <div>
                            <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $folder->name }}</h1>
                            @if($folder->description)
                                <p class="text-gray-600 dark:text-gray-400">{{ $folder->description }}</p>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Folder Stats -->
                    <div class="flex items-center space-x-6">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $firmware->count() }}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Files</div>
                        </div>
                        @if($subfolders->count() > 0)
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $subfolders->count() }}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Folders</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Search and Filter Bar -->
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl p-6 border border-gray-200/50 dark:border-gray-700/50 mb-8">
                <form method="GET" action="{{ route('folders.show', $folder) }}" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <div class="relative">
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}"
                                   placeholder="Search files in this folder..." 
                                   class="w-full px-4 py-3 pl-12 bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500/50 transition-all duration-300">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex gap-2">
                        <select name="sort" class="px-4 py-3 bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500/50 transition-all duration-300">
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Sort by Name</option>
                            <option value="date" {{ request('sort') == 'date' ? 'selected' : '' }}>Sort by Date</option>
                            <option value="size" {{ request('sort') == 'size' ? 'selected' : '' }}>Sort by Size</option>
                            <option value="downloads" {{ request('sort') == 'downloads' ? 'selected' : '' }}>Sort by Downloads</option>
                        </select>
                        
                        <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition-all duration-300 hover:scale-105">
                            Filter
                        </button>
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-3">
                    <!-- Subfolders Section -->
                    @if($subfolders->count() > 0)
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Subfolders</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($subfolders as $subfolder)
                                <div class="group cursor-pointer" onclick="window.location.href='{{ route('folders.show', $subfolder) }}'">
                                    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl p-4 border border-gray-200/50 dark:border-gray-700/50 hover:bg-white dark:hover:bg-gray-800 transition-all duration-300 hover:scale-105 hover:shadow-md">
                                        <div class="flex items-center space-x-3">
                                            @if ($subfolder->icon_path)
                                                <img src="{{ asset('storage/' . $subfolder->icon_path) }}"
                                                     alt="{{ $subfolder->name }} icon"
                                                     class="w-10 h-10 rounded-lg group-hover:scale-110 transition-transform duration-300">
                                            @else
                                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                            
                                            <div class="flex-1 min-w-0">
                                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300 truncate">{{ $subfolder->name }}</h3>
                                                <p class="text-xs text-gray-600 dark:text-gray-400">{{ $subfolder->firmware_count ?? 0 }} files</p>
                                            </div>
                                            
                                            <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 group-hover:translate-x-1 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Files Section -->
                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Files</h2>
                            <div class="flex items-center space-x-2">
                                <button class="p-2 text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200" title="Grid View">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                    </svg>
                                </button>
                                <button class="p-2 text-blue-600 dark:text-blue-400 transition-colors duration-200" title="List View">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        @if($firmware->count() > 0)
                            <div class="space-y-3">
                                @foreach ($firmware as $file)
                                    <div class="group">
                                        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl p-4 border border-gray-200/50 dark:border-gray-700/50 hover:bg-white dark:hover:bg-gray-800 transition-all duration-300 hover:shadow-md">
                                            <div class="flex items-center space-x-4">
                                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300">
                                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                    </svg>
                                                </div>
                                                
                                                <div class="flex-1 min-w-0">
                                                    <div class="flex items-center space-x-2 mb-1">
                                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300 truncate">{{ $file->name }}</h3>
                                                        @if($file->created_at->diffInHours(now()) < 24)
                                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300 border border-red-200 dark:border-red-700/50">
                                                                New
                                                            </span>
                                                        @elseif($file->downloads_count > 100)
                                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 border border-green-200 dark:border-green-700/50">
                                                                Popular
                                                            </span>
                                                        @endif
                                                    </div>
                                                    
                                                    @if($file->description)
                                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2 line-clamp-2">{{ $file->description }}</p>
                                                    @endif
                                                    
                                                    <div class="flex items-center space-x-4 text-sm text-gray-600 dark:text-gray-400">
                                                        <span>{{ $file->formatted_size ?? $file->size }}</span>
                                                        <span>•</span>
                                                        <span>{{ number_format($file->downloads_count) }} downloads</span>
                                                        <span>•</span>
                                                        <span>{{ $file->created_at->diffForHumans() }}</span>
                                                    </div>
                                                </div>
                                                
                                                <div class="flex items-center space-x-2">
                                                    @if($file->download_url)
                                                        <a href="{{ $file->download_url }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-all duration-300 hover:scale-105">
                                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                            </svg>
                                                            Download
                                                        </a>
                                                    @endif
                                                    
                                                    <a href="{{ route('firmware.show', $file) }}" class="inline-flex items-center px-4 py-2 bg-white/80 dark:bg-gray-700/80 text-gray-900 dark:text-white text-sm font-medium rounded-lg border border-gray-200/50 dark:border-gray-600/50 hover:bg-white dark:hover:bg-gray-700 transition-all duration-300 hover:scale-105 backdrop-blur-sm">
                                                        View Details
                                                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            @if($firmware->hasPages())
                            <div class="mt-8">
                                {{ $firmware->appends(request()->query())->links() }}
                            </div>
                            @endif
                        @else
                            <div class="text-center py-12">
                                <div class="w-16 h-16 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No Files Found</h3>
                                <p class="text-gray-600 dark:text-gray-400">This folder doesn't contain any files yet.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Folder Info -->
                    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl p-6 border border-gray-200/50 dark:border-gray-700/50">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Folder Information</h3>
                        
                        <div class="space-y-3">
                            <div class="flex items-center justify-between py-2 border-b border-gray-200 dark:border-gray-700 last:border-b-0">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Total Files</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $firmware->total() }}</span>
                            </div>
                            
                            @if($subfolders->count() > 0)
                            <div class="flex items-center justify-between py-2 border-b border-gray-200 dark:border-gray-700 last:border-b-0">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Subfolders</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $subfolders->count() }}</span>
                            </div>
                            @endif
                            
                            <div class="flex items-center justify-between py-2 border-b border-gray-200 dark:border-gray-700 last:border-b-0">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Created</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $folder->created_at->format('M d, Y') }}</span>
                            </div>
                            
                            <div class="flex items-center justify-between py-2 border-b border-gray-200 dark:border-gray-700 last:border-b-0">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Last Updated</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $folder->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl p-6 border border-gray-200/50 dark:border-gray-700/50">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Quick Actions</h3>
                        
                        <div class="space-y-3">
                            <button class="w-full flex items-center justify-center px-4 py-3 bg-gray-50 dark:bg-gray-700/50 text-gray-900 dark:text-white rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                                Add to Favorites
                            </button>
                            
                            <button class="w-full flex items-center justify-center px-4 py-3 bg-gray-50 dark:bg-gray-700/50 text-gray-900 dark:text-white rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4 19h6v2H4v-2zM4 15h10v2H4v-2zM4 11h10v2H4v-2zM4 7h10v2H4V7z"></path>
                                </svg>
                                Subscribe to Updates
                            </button>
                            
                            <button class="w-full flex items-center justify-center px-4 py-3 bg-gray-50 dark:bg-gray-700/50 text-gray-900 dark:text-white rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                </svg>
                                Share Folder
                            </button>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    @if(isset($recentActivity) && $recentActivity->count() > 0)
                    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl p-6 border border-gray-200/50 dark:border-gray-700/50">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Recent Activity</h3>
                        
                        <div class="space-y-3">
                            @foreach($recentActivity->take(5) as $activity)
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $activity->description }}</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">{{ $activity->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

