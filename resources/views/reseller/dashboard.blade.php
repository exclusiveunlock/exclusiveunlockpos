<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reseller Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Reseller Overview</h3>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow">
                            <p class="text-sm text-gray-600 dark:text-gray-400">Total Balance</p>
                            <p class="text-2xl font-bold">{{ Auth::user()->currency->symbol ?? '$' }}{{ number_format(Auth::user()->balance, 2) }}</p>
                        </div>
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow">
                            <p class="text-sm text-gray-600 dark:text-gray-400">Total Transfers</p>
                            <p class="text-2xl font-bold">{{ number_format($transferHistory->where('sender_id', Auth::id())->sum('amount'), 2) }}</p>
                        </div>
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow">
                            <p class="text-sm text-gray-600 dark:text-gray-400">Total Received</p>
                            <p class="text-2xl font-bold">{{ number_format($transferHistory->where('receiver_id', Auth::id())->sum('amount'), 2) }}</p>
                        </div>
                    </div>

                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Send Fund</h3>

                    <form method="POST" action="{{ route('reseller.send-fund') }}" class="space-y-4">
                        @csrf
                        <div>
                            <label for="receiver_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Receiver Email</label>
                            <input type="email" name="receiver_email" id="receiver_email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100" required>
                            @error('receiver_email')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Amount</label>
                            <input type="number" name="amount" id="amount" step="0.01" min="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100" required>
                            @error('amount')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Send Fund</button>
                    </form>

                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mt-8 mb-4">Transfer History</h3>

                    @if ($transferHistory->isEmpty())
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow">
                            <p class="text-sm text-gray-600 dark:text-gray-400">No transfer history yet.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Type</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Participant</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Amount</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($transferHistory as $transaction)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                @if ($transaction->sender_id === Auth::id())
                                                    <span class="text-red-600">Sent</span>
                                                @else
                                                    <span class="text-green-600">Received</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                @if ($transaction->sender_id === Auth::id())
                                                    {{ $transaction->receiver->email ?? 'N/A' }}
                                                @else
                                                    {{ $transaction->sender->email ?? 'N/A' }}
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                {{ Auth::user()->currency->symbol ?? '$' }}{{ number_format($transaction->amount, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                {{ $transaction->created_at->format('M d, Y H:i A') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>