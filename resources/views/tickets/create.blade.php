<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Open New Support Ticket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-6">Submit a New Ticket</h3>

                    <form method="POST" action="{{ route('tickets.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-input mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" value="{{ old('subject') }}" required>
                            @error('subject')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Message</label>
                            <textarea name="message" id="message" rows="8" class="form-textarea mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <button type="submit" class="btn-primary">
                                Submit Ticket
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
