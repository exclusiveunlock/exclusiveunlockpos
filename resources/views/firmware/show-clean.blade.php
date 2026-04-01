<x-app-layout>
    <x-slot name="title">
        @if($firmware->folder){{ $firmware->full_folder_path }} > @endif{{ $firmware->name }}
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
                    @if($firmware->folder)
                        <li>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <a href="{{ route('folders.show', $firmware->folder) }}" class="ml-1 text-sm font-medium text-gray-600 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400 transition-colors duration-200">{{ $firmware->folder->name }}</a>
                            </div>
                        </li>
                    @endif
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 dark:text-gray-400 truncate">{{ $firmware->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Clean Firmware Header Card -->
                    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl p-8 border border-gray-200/50 dark:border-gray-700/50 hover:bg-white dark:hover:bg-gray-800 transition-all duration-300">
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between mb-6">
                            <div class="flex-1">
                                <div class="flex items-center space-x-3 mb-4">
                                    <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    @if($firmware->created_at->diffInHours(now()) < 24)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300 border border-red-200 dark:border-red-700/50">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                            </svg>
                                            New Release
                                        </span>
                                    @elseif($firmware->downloads_count > 100)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 border border-green-200 dark:border-green-700/50">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                            </svg>
                                            Popular
                                        </span>
                                    @endif
                                </div>
                                
                                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white mb-3 leading-tight">{{ $firmware->name }}</h1>
                                
                                @if($firmware->description)
                                    <p class="text-gray-600 dark:text-gray-400 mb-4 leading-relaxed">{{ $firmware->description }}</p>
                                @endif
                                
                                <!-- File Info Grid -->
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                                    <div class="text-center p-3 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                                        <div class="text-lg font-bold text-gray-900 dark:text-white">{{ $firmware->formatted_size ?? $firmware->size }}</div>
                                        <div class="text-xs text-gray-600 dark:text-gray-400">File Size</div>
                                    </div>
                                    <div class="text-center p-3 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                                        <div class="text-lg font-bold text-gray-900 dark:text-white">{{ number_format($firmware->downloads_count) }}</div>
                                        <div class="text-xs text-gray-600 dark:text-gray-400">Downloads</div>
                                    </div>
                                    <div class="text-center p-3 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                                        <div class="text-lg font-bold text-gray-900 dark:text-white">{{ $firmware->created_at->format('M d, Y') }}</div>
                                        <div class="text-xs text-gray-600 dark:text-gray-400">Released</div>
                                    </div>
                                    <div class="text-center p-3 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                                        <div class="text-lg font-bold text-gray-900 dark:text-white">{{ $firmware->updated_at->format('M d, Y') }}</div>
                                        <div class="text-xs text-gray-600 dark:text-gray-400">Updated</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Download Section -->
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                            <div class="flex flex-col sm:flex-row gap-4">
                                @if($firmware->download_url)
                                    <a href="{{ $firmware->download_url }}" 
                                       class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all duration-300 hover:scale-105 hover:shadow-lg">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        Download Now
                                    </a>
                                @endif
                                
                                <button class="inline-flex items-center justify-center px-6 py-3 bg-white/80 dark:bg-gray-700/80 text-gray-900 dark:text-white font-semibold rounded-xl border border-gray-200/50 dark:border-gray-600/50 hover:bg-white dark:hover:bg-gray-700 transition-all duration-300 hover:scale-105 backdrop-blur-sm">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                    Add to Favorites
                                </button>
                                
                                <button class="inline-flex items-center justify-center px-6 py-3 bg-white/80 dark:bg-gray-700/80 text-gray-900 dark:text-white font-semibold rounded-xl border border-gray-200/50 dark:border-gray-600/50 hover:bg-white dark:hover:bg-gray-700 transition-all duration-300 hover:scale-105 backdrop-blur-sm">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                    </svg>
                                    Share
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    @if($firmware->changelog || $firmware->installation_notes)
                    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl p-8 border border-gray-200/50 dark:border-gray-700/50">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Additional Information</h2>
                        
                        @if($firmware->changelog)
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Changelog</h3>
                            <div class="prose dark:prose-invert max-w-none">
                                {!! nl2br(e($firmware->changelog)) !!}
                            </div>
                        </div>
                        @endif
                        
                        @if($firmware->installation_notes)
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Installation Notes</h3>
                            <div class="prose dark:prose-invert max-w-none">
                                {!! nl2br(e($firmware->installation_notes)) !!}
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- File Details Card -->
                    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl p-6 border border-gray-200/50 dark:border-gray-700/50">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">File Details</h3>
                        
                        <div class="space-y-4">
                            @if($firmware->folder)
                            <div class="flex items-center justify-between py-2 border-b border-gray-200 dark:border-gray-700 last:border-b-0">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Category</span>
                                <a href="{{ route('folders.show', $firmware->folder) }}" class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300">{{ $firmware->folder->name }}</a>
                            </div>
                            @endif
                            
                            <div class="flex items-center justify-between py-2 border-b border-gray-200 dark:border-gray-700 last:border-b-0">
                                <span class="text-sm text-gray-600 dark:text-gray-400">File Type</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ strtoupper(pathinfo($firmware->name, PATHINFO_EXTENSION)) }}</span>
                            </div>
                            
                            <div class="flex items-center justify-between py-2 border-b border-gray-200 dark:border-gray-700 last:border-b-0">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Added</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $firmware->created_at->diffForHumans() }}</span>
                            </div>
                            
                            <div class="flex items-center justify-between py-2 border-b border-gray-200 dark:border-gray-700 last:border-b-0">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Last Updated</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $firmware->updated_at->diffForHumans() }}</span>
                            </div>
                            
                            @if($firmware->version)
                            <div class="flex items-center justify-between py-2 border-b border-gray-200 dark:border-gray-700 last:border-b-0">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Version</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $firmware->version }}</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Related Files -->
                    @if(isset($relatedFirmware) && $relatedFirmware->count() > 0)
                    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl p-6 border border-gray-200/50 dark:border-gray-700/50">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Related Files</h3>
                        
                        <div class="space-y-3">
                            @foreach($relatedFirmware->take(5) as $related)
                            <div class="group">
                                <a href="{{ route('firmware.show', $related) }}" class="block p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                                    <div class="flex items-start space-x-3">
                                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200 truncate">{{ $related->name }}</p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">{{ $related->formatted_size ?? $related->size }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Quick Actions -->
                    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl p-6 border border-gray-200/50 dark:border-gray-700/50">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Quick Actions</h3>
                        
                        <div class="space-y-3">
                            <button class="w-full flex items-center justify-center px-4 py-3 bg-gray-50 dark:bg-gray-700/50 text-gray-900 dark:text-white rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Report Issue
                            </button>
                            
                            <button class="w-full flex items-center justify-center px-4 py-3 bg-gray-50 dark:bg-gray-700/50 text-gray-900 dark:text-white rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Get Help
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

