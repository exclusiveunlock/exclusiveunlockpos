@extends('layouts.app')

@section('title', 'My Profile - GSMXSTORE')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
        <div class="p-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">My Profile</h1>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Profile Information -->
                <div class="lg:col-span-1">
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                        <div class="text-center mb-6">
                            <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="text-white text-3xl font-bold">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $user->name }}</h2>
                            <p class="text-gray-600 dark:text-gray-400">{{ $user->email }}</p>
                        </div>
                        
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone</label>
                                <p class="text-gray-900 dark:text-white">{{ $user->phone ?? 'Not provided' }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Role</label>
                                <span class="inline-block bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 px-3 py-1 rounded-full text-sm">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Balance</label>
                                <p class="text-lg font-bold text-blue-600 dark:text-blue-400">৳{{ number_format($user->balance ?? 0, 2) }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <a href="{{ route('profile.edit') }}" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg text-center block transition-colors duration-200">
                                Edit Profile
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Order History -->
                <div class="lg:col-span-2">
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Order History</h2>
                            <a href="{{ route('store.order.tracking') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-sm">
                                View All Orders
                            </a>
                        </div>
                        
                        @if($orders->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                                    <thead class="bg-gray-100 dark:bg-gray-600">
                                        <tr>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Order ID</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Amount</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach($orders as $order)
                                        <tr>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $order->order_id }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $order->created_at->format('M d, Y') }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 dark:text-white">৳{{ number_format($order->total_amount, 2) }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
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
                                            <td class="px-4 py-3 whitespace-nowrap text-sm">
                                                <a href="{{ route('store.order.track', $order->order_id) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                                    Track Order
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="mt-6">
                                {{ $orders->links() }}
                            </div>
                        @else
                            <div class="text-center py-8">
                                <i class="fas fa-shopping-bag text-gray-400 text-4xl mb-4"></i>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No Orders Yet</h3>
                                <p class="text-gray-600 dark:text-gray-400">You haven't placed any orders.</p>
                                <a href="{{ route('store.index') }}" class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg transition-colors duration-200">
                                    Start Shopping
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection