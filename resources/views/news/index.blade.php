<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ app('settings')['site_name'] ?? __('Announcements') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-semibold mb-4">Latest Announcements</h3>

                    @if ($announcements->isEmpty())
                        <p>No announcements yet.</p>
                    @else
                        @foreach ($announcements as $announcement)
                            <div class="mb-6 pb-6 border-b border-gray-200 dark:border-gray-700 last:border-b-0">
                                <h4 class="text-lg font-bold mb-2">{{ $announcement->title }}</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Published: {{ $announcement->published_at->format('M d, Y H:i') }}</p>
                                <div class="prose dark:prose-invert">
                                    {{ $announcement->content }}
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
