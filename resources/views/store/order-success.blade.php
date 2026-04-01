@extends('layouts.app')

@section('title', 'Order Success - GSMXSTORE')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
        <div class="p-6 sm:p-8 text-center">
            <div class="w-24 h-24 bg-green-100 dark:bg-green-900/20 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-check-double text-green-600 dark:text-green-400 text-4xl"></i>
            </div>
            
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mb-3">Order Placed Successfully!</h1>
            <p class="text-gray-600 dark:text-gray-400 mb-2 max-w-2xl mx-auto">Thank you for your order. Your order has been placed successfully and is being processed.</p>
            
            <div class="mt-6 mb-8 p-5 sm:p-6 bg-gradient-to-r from-green-50 to-blue-50 dark:from-green-900/10 dark:to-blue-900/10 rounded-xl border border-green-100 dark:border-green-800/30">
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-green-100 dark:bg-green-900/20 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-envelope text-green-600 dark:text-green-400"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Confirmation Sent</p>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">To your email</p>
                        </div>
                    </div>
                    
                    <div class="hidden sm:block w-px h-10 bg-gray-200 dark:bg-gray-700"></div>
                    
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/20 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-truck text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Estimated Delivery</p>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Within 3-5 days</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-5 sm:p-6 mb-8 border border-blue-100 dark:border-blue-800/30">
                <h2 class="text-lg font-semibold text-blue-800 dark:text-blue-200 mb-3 flex items-center justify-center">
                    <i class="fas fa-info-circle mr-2"></i> What's Next?
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4">
                    <div class="p-3 bg-white dark:bg-gray-700/50 rounded-lg">
                        <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/20 rounded-full flex items-center justify-center mx-auto mb-2">
                            <i class="fas fa-cogs text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <h3 class="font-medium text-gray-900 dark:text-white text-sm">Processing</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-xs mt-1">We're preparing your order</p>
                    </div>
                    
                    <div class="p-3 bg-white dark:bg-gray-700/50 rounded-lg">
                        <div class="w-10 h-10 bg-yellow-100 dark:bg-yellow-900/20 rounded-full flex items-center justify-center mx-auto mb-2">
                            <i class="fas fa-shipping-fast text-yellow-600 dark:text-yellow-400"></i>
                        </div>
                        <h3 class="font-medium text-gray-900 dark:text-white text-sm">Shipping</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-xs mt-1">Your order is on the way</p>
                    </div>
                    
                    <div class="p-3 bg-white dark:bg-gray-700/50 rounded-lg">
                        <div class="w-10 h-10 bg-green-100 dark:bg-green-900/20 rounded-full flex items-center justify-center mx-auto mb-2">
                            <i class="fas fa-home text-green-600 dark:text-green-400"></i>
                        </div>
                        <h3 class="font-medium text-gray-900 dark:text-white text-sm">Delivered</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-xs mt-1">Order arrives at your door</p>
                    </div>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row justify-center gap-3 sm:gap-4">
                <a href="{{ route('store.order.tracking') }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white py-3 px-5 sm:px-6 rounded-lg font-semibold transition-colors duration-200">
                    <i class="fas fa-search-location mr-2"></i> Track Order
                </a>
                <a href="{{ route('store.index') }}" class="inline-flex items-center bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white py-3 px-5 sm:px-6 rounded-lg font-semibold transition-colors duration-200">
                    <i class="fas fa-shopping-bag mr-2"></i> Continue Shopping
                </a>
            </div>
        </div>
        
        <div class="bg-gray-50 dark:bg-gray-700/50 p-5 sm:p-6 border-t border-gray-200 dark:border-gray-700">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center">
                    <i class="fas fa-shield-alt text-green-600 dark:text-green-400 mr-2"></i>
                    <span class="text-gray-600 dark:text-gray-400 text-sm">Secure Payment Guaranteed</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-headset text-blue-600 dark:text-blue-400 mr-2"></i>
                    <span class="text-gray-600 dark:text-gray-400 text-sm">Need help? <a href="{{ route('tickets.create') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Contact Support</a></span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection