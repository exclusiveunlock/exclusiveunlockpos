<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
            </div>
            <h2 class="font-bold text-2xl text-gray-900 dark:text-white">
                {{ __('Account Statement') }}
            </h2>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-green-50 via-white to-emerald-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="text-center mb-8 animate-fade-in-down">
                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4 animate-pulse-slow">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Account Statement</h1>
                <p class="text-gray-600 dark:text-gray-400 text-lg">Track your account activity and transaction history</p>
            </div>

            @if ($statement->isEmpty())
                <!-- Empty State -->
                <div class="card-enhanced text-center py-16 animate-fade-in-up">
                    <div class="w-24 h-24 bg-gray-100 dark:bg-gray-800 rounded-3xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">No Activity Yet</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-8 max-w-md mx-auto">
                        Your account statement is empty. Start using our services to see your transaction history here.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('packages.index') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-semibold rounded-xl transition-all duration-300 btn-animated">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            Browse Packages
                        </a>
                        <a href="{{ route('funds.add') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold rounded-xl transition-all duration-300 btn-animated">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add Funds
                        </a>
                    </div>
                </div>
            @else
                <!-- Statement Content -->
                <div class="space-y-8">
                    <!-- Summary Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 animate-fade-in-up">
                        @php
                            $totalCredits = $statement->where('type', 'credit')->sum('amount');
                            $totalDebits = $statement->where('type', 'debit')->sum('amount');
                            $balance = $totalCredits - $totalDebits;
                        @endphp
                        
                        <div class="card-enhanced hover-lift">
                            <div class="p-6">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Credits</p>
                                        <p class="text-2xl font-bold text-gray-900 dark:text-white">${{ number_format($totalCredits, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-enhanced hover-lift">
                            <div class="p-6">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-pink-600 rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Debits</p>
                                        <p class="text-2xl font-bold text-gray-900 dark:text-white">${{ number_format($totalDebits, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-enhanced hover-lift">
                            <div class="p-6">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Net Balance</p>
                                        <p class="text-2xl font-bold {{ $balance >= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                            ${{ number_format($balance, 2) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="card-enhanced animate-fade-in-up">
                        <div class="p-6">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Transaction History</h3>
                                <div class="flex items-center space-x-4">
                                    <select class="form-input-enhanced text-sm max-w-xs">
                                        <option>All Types</option>
                                        <option>Credits</option>
                                        <option>Debits</option>
                                    </select>
                                    <select class="form-input-enhanced text-sm max-w-xs">
                                        <option>Last 30 days</option>
                                        <option>Last 90 days</option>
                                        <option>Last year</option>
                                        <option>All time</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statement Table -->
                    <div class="card-enhanced animate-fade-in-up">
                        <div class="overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="table-enhanced">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Date & Time</th>
                                            <th class="text-left">Type</th>
                                            <th class="text-left">Description</th>
                                            <th class="text-right">Amount</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($statement as $index => $item)
                                            <tr class="group animate-fade-in-up" style="animation-delay: {{ $index * 0.05 }}s">
                                                <td>
                                                    <div>
                                                        <div class="font-medium text-gray-900 dark:text-white">
                                                            {{ $item['date']->format('M d, Y') }}
                                                        </div>
                                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                                            {{ $item['date']->format('H:i') }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="flex items-center space-x-2">
                                                        @if($item['type'] === 'credit')
                                                            <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                                                                <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                                </svg>
                                                            </div>
                                                            <span class="font-medium text-green-700 dark:text-green-300">Credit</span>
                                                        @elseif($item['type'] === 'debit')
                                                            <div class="w-8 h-8 bg-red-100 dark:bg-red-900/30 rounded-lg flex items-center justify-center">
                                                                <svg class="w-4 h-4 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                                                </svg>
                                                            </div>
                                                            <span class="font-medium text-red-700 dark:text-red-300">Debit</span>
                                                        @elseif($item['type'] === 'fund_add')
                                                            <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                                                                <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                                </svg>
                                                            </div>
                                                            <span class="font-medium text-green-700 dark:text-green-300">Fund Added</span>
                                                        @else
                                                            <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                                                                <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                                                </svg>
                                                            </div>
                                                            <span class="font-medium text-gray-700 dark:text-gray-300">{{ ucfirst($item['type']) }}</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="max-w-xs">
                                                        <p class="font-medium text-gray-900 dark:text-white truncate">{{ $item['description'] }}</p>
                                                        @if(isset($item['reference']))
                                                            <p class="text-sm text-gray-500 dark:text-gray-400">Ref: {{ $item['reference'] }}</p>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="text-right">
                                                    @if ($item['amount'] !== null)
                                                        <span class="font-semibold {{ $item['type'] === 'credit' ? 'text-green-600 dark:text-green-400' : ($item['type'] === 'debit' ? 'text-red-600 dark:text-red-400' : 'text-gray-900 dark:text-white') }}">
                                                            {{ $item['type'] === 'credit' ? '+' : ($item['type'] === 'debit' ? '-' : '') }}${{ number_format($item['amount'], 2) }}
                                                        </span>
                                                    @else
                                                        <span class="text-gray-500 dark:text-gray-400">N/A</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @php
                                                        $statusColors = [
                                                            'completed' => 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300',
                                                            'pending' => 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300',
                                                            'failed' => 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300',
                                                            'cancelled' => 'bg-gray-100 dark:bg-gray-900/30 text-gray-800 dark:text-gray-300',
                                                        ];
                                                        $statusClass = $statusColors[$item['status']] ?? $statusColors['completed'];
                                                    @endphp
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $statusClass }}">
                                                        {{ ucfirst($item['status']) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Export Options -->
                    <div class="card-enhanced animate-fade-in-up">
                        <div class="p-6">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">Export Statement</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Download your transaction history in various formats</p>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <button class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            <span>Export PDF</span>
                                        </div>
                                    </button>
                                    <button class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            <span>Export CSV</span>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

