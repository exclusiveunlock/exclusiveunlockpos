<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $page->title }}
            </h2>
            
            @can('update', $page)
                <div class="flex space-x-2">
                    <a href="{{ route('pages.edit', $page) }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('Editar página') }}
                    </a>
                </div>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Metadata de la página --}}
            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                <span>Última actualización: {{ $page->updated_at->isoFormat('LLL') }}</span>
                @if($page->author)
                    <span class="mx-2">•</span>
                    <span>Por: {{ $page->author->name }}</span>
                @endif
            </div>

            {{-- Contenido principal --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 prose prose-lg max-w-none dark:prose-invert">
                    {!! $page->content !!}
                </div>
            </div>

            {{-- Sección de archivos adjuntos (si existen) --}}
            @if($page->attachments && $page->attachments->isNotEmpty())
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                        {{ __('Archivos adjuntos') }}
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($page->attachments as $attachment)
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
                                <div class="flex items-center space-x-3">
                                    {{-- Icono según tipo de archivo --}}
                                    <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linecap="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">
                                            {{ $attachment->original_name ?? $attachment->name ?? 'Archivo' }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ isset($attachment->size) ? number_format($attachment->size / 1024, 2) . ' KB' : 'Tamaño desconocido' }}
                                        </p>
                                    </div>
                                    @if(isset($attachment->id))
                                        <a href="{{ route('attachments.download', $attachment) }}" 
                                           class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300"
                                           title="{{ __('Descargar') }}">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linecap="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Navegación entre páginas --}}
            @if(method_exists($page, 'previous') && method_exists($page, 'next'))
            <div class="mt-8 flex justify-between">
                @php
                    $previousPage = method_exists($page, 'previous') ? $page->previous() : null;
                    $nextPage = method_exists($page, 'next') ? $page->next() : null;
                @endphp

                @if($previousPage)
                    <a href="{{ route('pages.show', $previousPage) }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        ← {{ __('Página anterior') }}
                    </a>
                @else
                    <div></div>
                @endif

                @if($nextPage)
                    <a href="{{ route('pages.show', $nextPage) }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('Página siguiente') }} →
                    </a>
                @else
                    <div></div>
                @endif
            </div>
            @endif

            {{-- Sección de comentarios --}}
            @if(config('pages.comments_enabled', false) && class_exists(\Livewire\Livewire::class))
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                        {{ __('Comentarios') }}
                    </h3>
                    @livewire('comments', ['model' => $page])
                </div>
            @endif
        </div>
    </div>

    @push('styles')
        {{-- Estilos para el contenido enriquecido --}}
        <style>
            .prose img {
                @apply rounded-lg shadow-md mx-auto;
            }
            .prose a {
                @apply text-blue-600 dark:text-blue-400 no-underline hover:underline;
            }
            .prose pre {
                @apply bg-gray-100 dark:bg-gray-900 rounded-lg p-4 overflow-x-auto;
            }
            .prose {
                max-width: none;
            }
            .prose img {
                max-width: 100%;
                height: auto;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Agregar target="_blank" a los enlaces externos
                document.querySelectorAll('.prose a').forEach(link => {
                    if (link.hostname && link.hostname !== window.location.hostname) {
                        link.setAttribute('target', '_blank');
                        link.setAttribute('rel', 'noopener noreferrer');
                    }
                });

                // Agregar funcionalidad a las imágenes
                document.querySelectorAll('.prose img').forEach(img => {
                    img.addEventListener('click', function() {
                        window.open(this.src, '_blank');
                    });
                    img.classList.add('cursor-pointer', 'hover:opacity-90', 'transition-opacity');
                });
            });
        </script>
    @endpush
</x-app-layout>