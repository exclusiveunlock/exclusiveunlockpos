@extends('layouts.app')

@section('title', 'Shopping Cart - GSMXSTORE')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 dark:bg-green-900/30 dark:border-green-700 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    @if(empty($cartItems) || count($cartItems) == 0)
        <div class="text-center py-12 sm:py-16">
            <i class="fas fa-shopping-cart text-gray-400 text-5xl sm:text-6xl mb-4"></i>
            <h3 class="text-xl sm:text-2xl font-semibold text-gray-900 dark:text-white mb-2">Your Cart is Empty</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-6">Looks like you haven't added any items to your cart yet.</p>
            <a href="{{ route('store.index') }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 sm:px-6 sm:py-3 rounded-lg font-semibold transition-colors duration-200">
                <i class="fas fa-shopping-bag mr-2"></i> Start Shopping
            </a>
        </div>
    @else
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
            <div class="p-5 sm:p-6 border-b border-gray-200 dark:border-gray-700">
                <h1 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                    <i class="fas fa-shopping-cart mr-3 text-blue-600 dark:text-blue-400"></i>
                    Shopping Cart
                </h1>
            </div>
            
            <div class="p-5 sm:p-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8">
                    <!-- Cart Items -->
                    <div class="lg:col-span-2">
                        <div class="space-y-4 sm:space-y-5">
                            @foreach($cartItems as $item)
                                <div class="flex flex-col sm:flex-row items-start sm:items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                    @if($item['product']->thumbnail)
                                        <img src="{{ asset('uploads/' . $item['product']->thumbnail) }}" alt="{{ $item['product']->title }}" class="w-16 h-16 sm:w-20 sm:h-20 object-cover rounded-lg">
                                    @else
                                        <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400 text-xl sm:text-2xl"></i>
                                        </div>
                                    @endif
                                    
                                    <div class="flex-1 mt-3 sm:mt-0 sm:ml-4 w-full">
                                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                            <div>
                                                <h3 class="font-semibold text-gray-900 dark:text-white line-clamp-1">{{ $item['product']->title }}</h3>
                                                <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">৳{{ number_format($item['price'], 2) }} each</p>
                                            </div>
                                            
                                            <div class="flex items-center mt-2 sm:mt-0">
                                                <div class="flex items-center border border-gray-300 dark:border-gray-600 rounded-lg mr-4">
                                                    <button type="button" class="quantity-btn px-3 py-1 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors" data-product-id="{{ $item['product']->id }}" data-action="decrease">
                                                        <i class="fas fa-minus text-xs"></i>
                                                    </button>
                                                    <span class="px-3 py-1 quantity-display">{{ $item['quantity'] }}</span>
                                                    <button type="button" class="quantity-btn px-3 py-1 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors" data-product-id="{{ $item['product']->id }}" data-action="increase">
                                                        <i class="fas fa-plus text-xs"></i>
                                                    </button>
                                                </div>
                                                
                                                <p class="font-bold text-blue-600 dark:text-blue-400 ml-2">৳{{ number_format($item['subtotal'], 2) }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="flex justify-between items-center mt-3 sm:mt-0">
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                @if($item['product']->stock_count > 0)
                                                    <span class="text-green-600 dark:text-green-400">
                                                        <i class="fas fa-check-circle mr-1"></i> {{ $item['product']->stock_count }} in stock
                                                    </span>
                                                @else
                                                    <span class="text-red-600 dark:text-red-400">
                                                        <i class="fas fa-times-circle mr-1"></i> Out of stock
                                                    </span>
                                                @endif
                                            </div>
                                            
                                            <form action="{{ route('store.cart.remove') }}" method="POST" class="ml-2">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $item['product']->id }}">
                                                <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 p-1 rounded hover:bg-red-100 dark:hover:bg-red-900/30 transition-colors" title="Remove item">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Cart Summary -->
                    <div>
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-5 sm:p-6 sticky top-24">
                            <h2 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                                <i class="fas fa-receipt mr-2"></i> Order Summary
                            </h2>
                            
                            <div class="space-y-3 mb-6">
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-300">Subtotal</span>
                                    <span class="text-gray-900 dark:text-white">৳{{ number_format($total, 2) }}</span>
                                </div>
                                
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-300">Delivery</span>
                                    <span class="text-green-600 dark:text-green-400 flex items-center">
                                        <i class="fas fa-shipping-fast mr-1"></i> Free
                                    </span>
                                </div>
                                
                                <div class="border-t border-gray-200 dark:border-gray-600 pt-3">
                                    <div class="flex justify-between">
                                        <span class="text-lg font-semibold text-gray-900 dark:text-white">Total</span>
                                        <span class="text-lg font-bold text-blue-600 dark:text-blue-400">৳{{ number_format($total, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <a href="{{ route('store.checkout') }}" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg font-semibold text-center block transition-colors duration-200 flex items-center justify-center">
                                <i class="fas fa-credit-card mr-2"></i> Proceed to Checkout
                            </a>
                            
                            <a href="{{ route('store.products') }}" class="w-full mt-3 text-center bg-gray-200 hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500 text-gray-800 dark:text-white py-3 px-4 rounded-lg font-semibold block transition-colors duration-200 flex items-center justify-center">
                                <i class="fas fa-arrow-left mr-2"></i> Continue Shopping
                            </a>
                        </div>
                        
                        <div class="mt-5 sm:mt-6 bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4">
                            <div class="flex items-start">
                                <i class="fas fa-shield-alt text-blue-600 dark:text-blue-400 mt-0.5 mr-2"></i>
                                <div>
                                    <h4 class="font-semibold text-blue-800 dark:text-blue-200 text-sm">Secure Checkout</h4>
                                    <p class="text-blue-700 dark:text-blue-300 text-xs mt-1">Your payment information is encrypted and secure.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Quantity selector functionality
    const quantityBtns = document.querySelectorAll('.quantity-btn');
    quantityBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            const action = this.getAttribute('data-action');
            
            // Implement AJAX call to update cart quantity
            // This would normally make an API request to update the cart
            console.log(`Update quantity for product ${productId}: ${action}`);
            
            // Show loading state
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            
            // Simulate API call delay
            setTimeout(() => {
                // Reset button
                if (action === 'increase') {
                    this.innerHTML = '<i class="fas fa-plus text-xs"></i>';
                } else {
                    this.innerHTML = '<i class="fas fa-minus text-xs"></i>';
                }
                
                // In a real implementation, you would update the DOM with new quantities and totals
                alert('In a complete implementation, this would update the cart quantity via AJAX.');
            }, 500);
        });
    });
});
</script>
@endsection