<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @isset($firmware)
                Report Issue for {{ $firmware->name }}
            @else
                Submit a General Report
            @endisset
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="@isset($firmware){{ route('firmware.report.store', $firmware) }}@else{{ route('reports.store') }}@endisset" enctype="multipart/form-data">
                        @csrf

                        @isset($firmware)
                            <input type="hidden" name="firmware_id" value="{{ $firmware->id }}">
                        @endisset

                        <!-- Subject -->
                        <div>
                            <x-input-label for="subject" :value="__('Subject')" />
                            <x-text-input id="subject" class="block mt-1 w-full" type="text" name="subject" :value="old('subject')" required autofocus />
                            <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description (Optional)')" />
                            <x-textarea id="description" class="block mt-1 w-full" name="description">{{ old('description') }}</x-textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Image Upload -->
                        <div class="mt-4">
                            <x-input-label for="image" :value="__('Image (Optional)')" />
                            <input id="image" type="file" name="image" class="block mt-1 w-full text-gray-900 dark:text-gray-100 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Submit Report') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @isset($userReports)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="font-semibold text-lg mb-4">Your Previous Reports</h3>
                        @forelse($userReports as $report)
                            <div class="border-b border-gray-200 dark:border-gray-700 pb-4 mb-4 last:border-b-0 last:pb-0 last:mb-0">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Reported on: {{ $report->created_at->format('M d, Y H:i A') }}</p>
                                <p class="text-lg font-medium">Subject: {{ $report->subject }}</p>
                                @if($report->description)
                                    <p class="text-sm text-gray-600 dark:text-gray-300">Description: {{ $report->description }}</p>
                                @endif
                                @if($report->firmware)
                                    <p class="text-sm text-gray-600 dark:text-gray-300">Firmware: {{ $report->firmware->name }}</p>
                                @endif
                                @if($report->image_path)
                                    <div class="mt-2">
                                        <img src="{{ Storage::url($report->image_path) }}" alt="Report Image" class="max-w-xs rounded-lg shadow-md">
                                    </div>
                                @endif
                                <p class="text-sm font-semibold mt-2">Status: <span class="
                                    @if($report->status == 'pending') text-yellow-500
                                    @elseif($report->status == 'in_progress') text-blue-500
                                    @elseif($report->status == 'resolved') text-green-500
                                    @elseif($report->status == 'rejected') text-red-500
                                    @endif
                                ">{{ ucfirst($report->status) }}</span></p>
                            </div>
                        @empty
                            <p>You have not submitted any reports yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    @endisset
</x-app-layout>
