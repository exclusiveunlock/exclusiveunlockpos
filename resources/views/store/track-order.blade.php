@extends('layouts.app')

@section('title', 'Track Order - ' . $order->order_id . ' - GSMXSTORE')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white">Order #{{ $order->order_id }}</h1>
        <div class="mt-2 sm:mt-0 flex items-center">
            <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full text-sm font-medium">
                {{ $order->created_at->format('M d, Y') }}
            </span>
            <a href="{{ route('store.order.tracking') }}" class="ml-4 inline-flex items-center text-blue-600 dark:text-blue-400 hover:underline text-sm">
                <i class="fas fa-arrow-left mr-1"></i> Back to Orders
            </a>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8">
        <!-- Order Details -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                <div class="p-5 sm:p-6 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                        <i class="fas fa-box mr-3 text-blue-600 dark:text-blue-400"></i>
                        Order Details
                    </h2>
                </div>
                
                <div class="p-5 sm:p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6 mb-6">
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4 sm:p-5">
                            <h3 class="font-semibold text-gray-700 dark:text-gray-300 text-sm mb-1">Product</h3>
                            <p class="text-gray-900 dark:text-white font-medium">{{ $order->product->title }}</p>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4 sm:p-5">
                            <h3 class="font-semibold text-gray-700 dark:text-gray-300 text-sm mb-1">Quantity</h3>
                            <p class="text-gray-900 dark:text-white font-medium">{{ $order->quantity }}</p>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4 sm:p-5">
                            <h3 class="font-semibold text-gray-700 dark:text-gray-300 text-sm mb-1">Total Amount</h3>
                            <p class="text-xl sm:text-2xl font-bold text-blue-600 dark:text-blue-400">@currency($order->total_amount)</p>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4 sm:p-5">
                            <h3 class="font-semibold text-gray-700 dark:text-gray-300 text-sm mb-1">Payment Method</h3>
                            <p class="text-gray-900 dark:text-white font-medium">
                                @if($order->payment_method === 'piprapay')
                                    GsmXPay
                                @else
                                    {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}
                                @endif
                            </p>
                        </div>
                    </div>
                    
                    @if($order->notes)
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4 sm:p-5 mb-6">
                            <h3 class="font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                                <i class="fas fa-sticky-note mr-2"></i> Notes
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400">{{ $order->notes }}</p>
                        </div>
                    @endif
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">
                        @if($order->shippingAddress)
                            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4 sm:p-5">
                                <h3 class="font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                                    <i class="fas fa-truck mr-2"></i> Shipping Address
                                </h3>
                                <p class="text-gray-600 dark:text-gray-400">
                                    {{ $order->shippingAddress->first_name }} {{ $order->shippingAddress->last_name }}<br>
                                    {{ $order->shippingAddress->street_address }}<br>
                                    {{ $order->shippingAddress->city }}, {{ $order->shippingAddress->state }} {{ $order->shippingAddress->zip_code }}<br>
                                    Phone: {{ $order->shippingAddress->phone_number }}
                                    @if($order->shippingAddress->extra_note)<br>Note: {{ $order->shippingAddress->extra_note }}@endif
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Order Status -->
        <div>
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden sticky top-24">
                <div class="p-5 sm:p-6 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                        <i class="fas fa-map-marked-alt mr-3 text-blue-600 dark:text-blue-400"></i>
                        Order Status
                    </h2>
                </div>
                
                <div class="p-5 sm:p-6">
                    <!-- Order Status Timeline -->
                    <div class="relative">
                        <!-- Pending -->
                        <div class="relative pb-8 last:pb-0">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center 
                                    @if($order->order_status === 'pending') 
                                        bg-yellow-500 border-2 border-yellow-600
                                    @else
                                        bg-gray-200 dark:bg-gray-600
                                    @endif">
                                    <i class="fas fa-receipt text-white text-xs"></i>
                                </div>
                                <div class="ml-4 min-w-0 flex-1">
                                    <div class="text-sm">
                                        <h3 class="font-semibold text-gray-900 dark:text-white">Order Placed</h3>
                                        <p class="text-gray-600 dark:text-gray-400 text-xs sm:text-sm mt-1">
                                            {{ $order->created_at->format('M d, Y h:i A') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Processing -->
                        <div class="relative pb-8 last:pb-0">
                            <div class="absolute left-4 top-8 w-0.5 h-8 
                                @if(in_array($order->order_status, ['processing', 'delivered'])) 
                                    bg-blue-500
                                @else
                                    bg-gray-200 dark:bg-gray-600
                                @endif">
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center 
                                    @if($order->order_status === 'processing') 
                                        bg-blue-500 border-2 border-blue-600
                                    @elseif($order->order_status === 'delivered')
                                        bg-blue-500 border-2 border-blue-600
                                    @else
                                        bg-gray-200 dark:bg-gray-600
                                    @endif">
                                    <i class="fas fa-cogs text-white text-xs"></i>
                                </div>
                                <div class="ml-4 min-w-0 flex-1">
                                    <div class="text-sm">
                                        <h3 class="font-semibold text-gray-900 dark:text-white">Processing</h3>
                                        <p class="text-gray-600 dark:text-gray-400 text-xs sm:text-sm mt-1">
                                            @if($order->order_status === 'processing' || $order->order_status === 'delivered')
                                                {{ $order->updated_at->format('M d, Y h:i A') }}
                                            @else
                                                -
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Delivered -->
                        <div class="relative">
                            <div class="absolute left-4 top-8 w-0.5 h-8 
                                @if($order->order_status === 'delivered') 
                                    bg-green-500
                                @else
                                    bg-gray-200 dark:bg-gray-600
                                @endif">
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center 
                                    @if($order->order_status === 'delivered') 
                                        bg-green-500 border-2 border-green-600
                                    @else
                                        bg-gray-200 dark:bg-gray-600
                                    @endif">
                                    <i class="fas fa-home text-white text-xs"></i>
                                </div>
                                <div class="ml-4 min-w-0 flex-1">
                                    <div class="text-sm">
                                        <h3 class="font-semibold text-gray-900 dark:text-white">Delivered</h3>
                                        <p class="text-gray-600 dark:text-gray-400 text-xs sm:text-sm mt-1">
                                            @if($order->order_status === 'delivered')
                                                {{ $order->updated_at->format('M d, Y h:i A') }}
                                            @else
                                                -
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Current Status Cards -->
                    <div class="mt-8 space-y-4">
                        <div class="p-4 rounded-lg 
                            @if($order->order_status === 'delivered') 
                                bg-green-100 dark:bg-green-900/20 border border-green-200 dark:border-green-700
                            @elseif($order->order_status === 'processing') 
                                bg-blue-100 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700
                            @elseif($order->order_status === 'pending') 
                                bg-yellow-100 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-700
                            @else 
                                bg-red-100 dark:bg-red-900/20 border border-red-200 dark:border-red-700
                            @endif">
                            <h3 class="font-semibold text-center flex items-center justify-center 
                                @if($order->order_status === 'delivered') 
                                    text-green-800 dark:text-green-200
                                @elseif($order->order_status === 'processing') 
                                    text-blue-800 dark:text-blue-200
                                @elseif($order->order_status === 'pending') 
                                    text-yellow-800 dark:text-yellow-200
                                @else 
                                    text-red-800 dark:text-red-200
                                @endif">
                                <i class="fas fa-info-circle mr-2"></i>
                                Current Status: {{ ucfirst($order->order_status) }}
                            </h3>
                        </div>
                        
                        <div class="p-4 rounded-lg 
                            @if($order->payment_status === 'paid') 
                                bg-green-100 dark:bg-green-900/20 border border-green-200 dark:border-green-700
                            @elseif($order->payment_status === 'pending') 
                                bg-yellow-100 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-700
                            @else 
                                bg-red-100 dark:bg-red-900/20 border border-red-200 dark:border-red-700
                            @endif">
                            <h3 class="font-semibold text-center flex items-center justify-center 
                                @if($order->payment_status === 'paid') 
                                    text-green-800 dark:text-green-200
                                @elseif($order->payment_status === 'pending') 
                                    text-yellow-800 dark:text-yellow-200
                                @else 
                                    text-red-800 dark:text-red-200
                                @endif">
                                <i class="fas fa-wallet mr-2"></i>
                                Payment Status: {{ ucfirst($order->payment_status) }}
                            </h3>
                            @if($order->payment_status !== 'paid' && $order->payment_method !== 'cod')
                            <div class="mt-4">
                                <form action="{{ route('store.pay-order', ['order' => $order->id]) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="payment_method" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Select Payment Method</label>
                                        <select name="payment_method" id="payment_method" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            @foreach($activePaymentGateways as $gateway)
                                                <option value="{{ $gateway->type }}" {{ old('payment_method', $order->payment_method) == $gateway->type ? 'selected' : '' }}>
                                                    {{ $gateway->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            <i class="fas fa-money-bill mr-2"></i> Pay Now
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endif
                        </div>
                    </div>
                    
                    <!-- Need Help -->
                    <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-700">
                        <div class="flex items-start">
                            <i class="fas fa-question-circle text-blue-600 dark:text-blue-400 mt-0.5 mr-2"></i>
                            <div>
                                <h4 class="font-semibold text-blue-800 dark:text-blue-200 text-sm">Need Help?</h4>
                                <p class="text-blue-700 dark:text-blue-300 text-xs mt-1">
                                    Contact our support team if you have any questions about your order.
                                </p>
                                <a href="{{ route('tickets.create') }}" class="mt-2 inline-flex items-center text-blue-600 dark:text-blue-400 hover:underline text-xs font-medium">
                                    <i class="fas fa-headset mr-1"></i> Contact Support
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection