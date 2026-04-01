@extends('layouts.app')

@section('title', 'Order Tracking - GSMXSTORE')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white">Order Tracking</h1>
        <div class="mt-2 sm:mt-0">
            <a href="{{ route('store.index') }}" class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:underline text-sm">
                <i class="fas fa-arrow-left mr-1"></i> Back to Store
            </a>
        </div>
    </div>
    
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
        <div class="p-5 sm:p-6 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white flex items-center">
                <i class="fas fa-history mr-3 text-blue-600 dark:text-blue-400"></i>
                Your Order History
            </h2>
        </div>
        
        @if($orders->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Order ID</th>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider hidden sm:table-cell">Product</th>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Amount</th>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Payment</th>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($orders as $order)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                <div class="flex items-center">
                                    <i class="fas fa-receipt text-gray-400 dark:text-gray-500 mr-2"></i>
                                    <span>{{ $order->order_id }}</span>
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-xs sm:text-sm text-gray-500 dark:text-gray-400">
                                {{ $order->created_at->format('M d, Y') }}
                                <div class="text-xs text-gray-400 dark:text-gray-500 sm:hidden">
                                    {{ $order->product->title }}
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white hidden sm:table-cell">
                                {{ Str::limit($order->product->title, 30) }}
                            </td>
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900 dark:text-white">
                                @currency($order->total_amount)
                            </td>
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 inline-flex text-xs leading-4 font-semibold rounded-full 
                                    @if($order->payment_status === 'paid') 
                                        bg-green-100 text-green-800 dark:bg-green-800/20 dark:text-green-400
                                    @elseif($order->payment_status === 'pending')
                                        bg-yellow-100 text-yellow-800 dark:bg-yellow-800/20 dark:text-yellow-400
                                    @else
                                        bg-red-100 text-red-800 dark:bg-red-800/20 dark:text-red-400
                                    @endif">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </td>
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 inline-flex text-xs leading-4 font-semibold rounded-full 
                                    @if($order->order_status === 'delivered') 
                                        bg-green-100 text-green-800 dark:bg-green-800/20 dark:text-green-400
                                    @elseif($order->order_status === 'processing')
                                        bg-blue-100 text-blue-800 dark:bg-blue-800/20 dark:text-blue-400
                                    @elseif($order->order_status === 'pending')
                                        bg-yellow-100 text-yellow-800 dark:bg-yellow-800/20 dark:text-yellow-400
                                    @else
                                        bg-red-100 text-red-800 dark:bg-red-800/20 dark:text-red-400
                                    @endif">
                                    {{ ucfirst($order->order_status) }}
                                </span>
                            </td>
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm">
                                <a href="{{ route('store.order.track', $order->order_id) }}" 
                                   class="inline-flex items-center text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 font-medium">
                                    <i class="fas fa-search mr-1"></i> Track
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="p-5 sm:p-6 border-t border-gray-200 dark:border-gray-700">
                {{ $orders->links('vendor.pagination.tailwind') }}
            </div>
        @else
            <div class="text-center py-12 sm:py-16">
                <div class="mx-auto w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-5">
                    <i class="fas fa-box-open text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl sm:text-2xl font-semibold text-gray-900 dark:text-white mb-2">No Orders Found</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6 max-w-md mx-auto">You haven't placed any orders yet. Start shopping to see your order history here.</p>
                <a href="{{ route('store.index') }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 sm:px-6 sm:py-3 rounded-lg font-semibold transition-colors duration-200">
                    <i class="fas fa-shopping-bag mr-2"></i> Start Shopping
                </a>
            </div>
        @endif
    </div>
</div>
@endsection