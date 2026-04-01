<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Support Ticket') }} #{{ $ticket->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold">Ticket #{{ $ticket->id }}: {{ $ticket->subject }}</h3>
                        <span class="px-3 py-1 rounded-full text-sm font-semibold 
                            @if($ticket->status === 'open') bg-green-100 text-green-800
                            @elseif($ticket->status === 'pending') bg-yellow-100 text-yellow-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ ucfirst($ticket->status) }}
                        </span>
                    </div>

                    <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Opened by {{ $ticket->user->name }} on {{ $ticket->created_at->format('M d, Y H:i A') }}</p>
                        <p class="text-gray-800 dark:text-gray-200">{{ $ticket->message }}</p>
                    </div>

                    <h4 class="text-xl font-bold mb-4">Replies</h4>
                    <div class="space-y-4 mb-6">
                        @forelse ($ticket->replies as $reply)
                            <div class="p-4 rounded-lg 
                                @if($reply->user->id === Auth::id()) bg-blue-50 dark:bg-blue-900/20 ml-auto text-right
                                @else bg-gray-50 dark:bg-gray-700/50 mr-auto
                                @endif">
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                                    <strong>{{ $reply->user->name }}</strong> replied on {{ $reply->created_at->format('M d, Y H:i A') }}
                                </p>
                                <p class="text-gray-800 dark:text-gray-200">{{ $reply->message }}</p>
                            </div>
                        @empty
                            <p class="text-gray-600 dark:text-gray-400">No replies yet.</p>
                        @endforelse
                    </div>

                    <h4 class="text-xl font-bold mb-4">Add Reply</h4>
                    <form method="POST" action="{{ route('tickets.reply', $ticket) }}">
                        @csrf
                        <div class="mb-4">
                            <textarea name="message" id="message" rows="4" class="form-textarea mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" placeholder="Type your reply here..." required></textarea>
                            @error('message')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex items-center justify-end">
                            <button type="submit" class="btn-primary">Submit Reply</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
