<nav class="text-sm font-medium text-gray-500 dark:text-gray-400" aria-label="Breadcrumb">
    <ol class="list-none p-0 inline-flex">
        @foreach ($pathSegments as $index => $segment)
            <li class="flex items-center">
                @if ($index > 0)
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-300 dark:text-gray-600 mx-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path d="M5.555 17.776l8-16 .445.224-8 16-.445-.224z" />
                    </svg>
                @endif
                @if (!$loop->last)
                    <a href="{{ $segment['url'] }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-600">{{ $segment['name'] }}</a>
                @else
                    <span class="text-gray-800 dark:text-gray-200">{{ $segment['name'] }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
