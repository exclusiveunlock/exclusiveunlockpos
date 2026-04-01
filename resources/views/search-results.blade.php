<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Search Results for "{{ $searchQuery }}"</h1>

        @if($folders->count() > 0 || $firmwares->count() > 0)
            @if($folders->count() > 0)
                <section class="mb-8">
                    <h2 class="text-2xl font-semibold mb-4">Folders</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach ($folders as $folder)
                            <div class="card group cursor-pointer" onclick="window.location.href='{{ route('folders.show', $folder) }}'">
                                <div class="card-body text-center">
                                    <div class="mb-4">
                                        @if ($folder->icon_path)
                                            <img src="{{ asset($folder->icon_path) }}" alt="{{ $folder->name }} icon" class="w-16 h-16 mx-auto rounded-lg">
                                        @else
                                            <img src="{{ asset('images/gsmxstore/folder.png') }}" alt="{{ $folder->name }} icon" class="w-16 h-16 mx-auto rounded-lg">
                                        @endif
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ $folder->name }}</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">{{ $folder->description ?? 'Firmware files for ' . $folder->name }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            @if($firmwares->count() > 0)
                <section>
                    <h2 class="text-2xl font-semibold mb-4">Firmware</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach ($firmwares as $firmware)
                            <div class="card group cursor-pointer" onclick="window.location.href='{{ route('firmware.show', $firmware) }}'">
                                <div class="card-body text-center">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ $firmware->name }}</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">{{ $firmware->formatted_size ?? 'N/A' }} • {{ number_format($firmware->downloads_count) }} downloads • {{ $firmware->file_extension ?? 'N/A' }} • <span class="font-bold text-blue-600 dark:text-blue-400">{{ $firmware->type ?? 'N/A' }}@if($firmware->type == 'Paid') ({{ $firmware->price ?? 'N/A' }})@endif</span></p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif
        @else
            <div class="text-center py-16">
                <p class="text-xl text-gray-600 dark:text-gray-400">No results found for "{{ $searchQuery }}".</p>
            </div>
        @endif
    </div>
</x-app-layout>
