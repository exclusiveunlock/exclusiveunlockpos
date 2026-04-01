@extends('layouts.app')

@section('title', $product->title . ' - GSMXSTORE')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 dark:bg-green-900/30 dark:border-green-700 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8 p-5 sm:p-8">
            <!-- Product Image -->
            <div class="flex flex-col">
                @if($product->thumbnail)
                    <img src="{{ asset('uploads/' . $product->thumbnail) }}" alt="{{ $product->title }}" class="w-full h-80 sm:h-96 object-contain rounded-lg bg-gray-100 dark:bg-gray-700 p-4">
                @else
                    <div class="bg-gray-100 dark:bg-gray-700 w-full h-80 sm:h-96 flex items-center justify-center rounded-lg">
                        <i class="fas fa-image text-gray-400 text-5xl sm:text-6xl"></i>
                    </div>
                @endif
                
                <!-- Thumbnails or additional images could go here -->
            </div>

            <!-- Product Details -->
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mb-3 sm:mb-4">{{ $product->title }}</h1>
                
                <div class="flex flex-wrap items-center gap-3 mb-4">
                    <span class="text-2xl sm:text-3xl font-bold text-blue-600 dark:text-blue-400">
                        @currency($product->price)
                    </span>
                    @if($product->delivery_charge > 0)
                        <span class="text-gray-600 dark:text-gray-400 text-sm sm:text-base">
                            + @currency($product->delivery_charge) delivery
                        </span>
                    @else
                        <span class="inline-flex items-center text-green-600 dark:text-green-400 font-medium text-sm sm:text-base">
                            <i class="fas fa-shipping-fast mr-1"></i> Free Delivery
                        </span>
                    @endif
                </div>

                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="inline-flex items-center bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 px-3 py-1 rounded-full text-xs sm:text-sm font-medium">
                        <i class="fas fa-{{ $product->type == 'free' ? 'gift' : 'tag' }} mr-1"></i>
                        {{ $product->type == 'free' ? 'Free' : 'Paid' }}
                    </span>
                    @if($product->is_cod_available)
                        <span class="inline-flex items-center bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 px-3 py-1 rounded-full text-xs sm:text-sm font-medium">
                            <i class="fas fa-money-bill-wave mr-1"></i> Cash on Delivery
                        </span>
                    @endif
                </div>

                @if($product->category)
                    <div class="mb-3">
                        <span class="text-gray-600 dark:text-gray-400 text-sm">Category: </span>
                        <a href="{{ route('store.products', ['category' => $product->category->name]) }}" class="text-blue-600 dark:text-blue-400 hover:underline text-sm">
                            {{ $product->category->name }}
                        </a>
                    </div>
                @endif

                @if($product->tags->count() > 0)
                    <div class="mb-4">
                        <span class="text-gray-600 dark:text-gray-400 text-sm">Tags: </span>
                        <div class="flex flex-wrap gap-1 mt-1">
                            @foreach($product->tags as $tag)
                                <a href="{{ route('store.products', ['tag' => $tag->name]) }}" class="inline-block bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-2 py-1 rounded text-xs hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                    {{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="mb-5">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Description</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm sm:text-base leading-relaxed">{{ $product->description }}</p>
                </div>

                <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <div class="flex items-center">
                            <span class="text-gray-600 dark:text-gray-400 mr-2">Stock: </span>
                            @if($product->stock_count > 0)
                                <span class="inline-flex items-center text-green-600 dark:text-green-400 font-medium">
                                    <i class="fas fa-check-circle mr-1"></i> {{ $product->stock_count }} available
                                </span>
                            @else
                                <span class="inline-flex items-center text-red-600 dark:text-red-400 font-medium">
                                    <i class="fas fa-times-circle mr-1"></i> Out of Stock
                                </span>
                            @endif
                        </div>
                        @if($product->sku)
                            <div>
                                <span class="text-gray-600 dark:text-gray-400 text-sm">SKU: </span>
                                <span class="text-gray-900 dark:text-white text-sm font-mono">{{ $product->sku }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                @if($product->stock_count > 0)
                    <form action="{{ route('store.cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        <div class="mb-5">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Quantity</label>
                            <div class="flex items-center">
                                <button type="button" class="quantity-btn bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white px-3 py-2 rounded-l-lg border border-gray-300 dark:border-gray-600 hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock_count }}"
                                       class="w-16 sm:w-20 text-center px-3 py-2 border-y border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white quantity-input" readonly>
                                <button type="button" class="quantity-btn bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white px-3 py-2 rounded-r-lg border border-gray-300 dark:border-gray-600 hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <span class="ml-3 text-gray-600 dark:text-gray-400 text-sm">of {{ $product->stock_count }}</span>
                            </div>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row gap-3">
                            <button type="submit" class="flex-1 bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-lg font-semibold transition-colors duration-200 flex items-center justify-center">
                                <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                            </button>
                            <a href="{{ route('store.checkout') }}?product_id={{ $product->id }}" class="flex-1 bg-purple-600 hover:bg-purple-700 text-white py-3 px-4 rounded-lg font-semibold text-center transition-colors duration-200 flex items-center justify-center">
                                <i class="fas fa-bolt mr-2"></i> Buy Now
                            </a>
                        </div>
                    </form>
                @else
                    <button class="w-full bg-gray-400 text-white py-3 px-6 rounded-lg font-semibold cursor-not-allowed" disabled>
                        Out of Stock
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
    <section class="mt-10 sm:mt-12">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white">Related Products</h2>
            <a href="{{ route('store.products') }}" class="mt-2 sm:mt-0 text-blue-600 dark:text-blue-400 hover:underline text-sm">
                View All Products
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            @foreach($relatedProducts as $relatedProduct)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-200 border border-gray-100 dark:border-gray-700 group">
                    <div class="relative">
                        @if($relatedProduct->thumbnail)
                            <img src="{{ asset('uploads/' . $relatedProduct->thumbnail) }}" alt="{{ $relatedProduct->title }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="bg-gray-200 dark:bg-gray-700 w-full h-48 flex items-center justify-center">
                                <i class="fas fa-image text-gray-400 text-4xl"></i>
                            </div>
                        @endif
                        @if($relatedProduct->stock_count <= 0)
                            <div class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
                                SOLD OUT
                            </div>
                        @endif
                    </div>
                    <div class="p-4 sm:p-5">
                        <h3 class="text-base sm:text-lg font-semibold mb-1 text-gray-900 dark:text-white line-clamp-1">{{ $relatedProduct->title }}</h3>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-lg sm:text-xl font-bold text-blue-600 dark:text-blue-400">
                                @currency($relatedProduct->price)
                            </span>
                            @if($relatedProduct->stock_count > 0)
                                <span class="text-green-600 dark:text-green-400 text-xs">
                                    <i class="fas fa-check-circle mr-1"></i> {{ $relatedProduct->stock_count }} left
                                </span>
                            @else
                                <span class="text-red-600 dark:text-red-400 text-xs">
                                    <i class="fas fa-times-circle mr-1"></i> Out of Stock
                                </span>
                            @endif
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('store.product.show', $relatedProduct->id) }}" 
                               class="flex-1 text-center bg-blue-600 hover:bg-blue-700 text-white py-2 px-3 rounded-lg text-sm transition-colors duration-200 flex items-center justify-center">
                                <i class="fas fa-eye mr-1.5"></i> Details
                            </a>
                            @if($relatedProduct->stock_count > 0)
                                <form action="{{ route('store.cart.add') }}" method="POST" class="flex-1">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $relatedProduct->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" 
                                            class="w-full bg-green-600 hover:bg-green-700 text-white py-2 px-3 rounded-lg text-sm transition-colors duration-200 flex items-center justify-center">
                                        <i class="fas fa-shopping-cart mr-1.5"></i> Cart
                                    </button>
                                </form>
                            @else
                                <button class="w-full bg-gray-400 text-white py-2 px-3 rounded-lg text-sm cursor-not-allowed flex items-center justify-center" disabled>
                                    <i class="fas fa-ban mr-1.5"></i> Sold
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Quantity selector functionality
    const quantityBtns = document.querySelectorAll('.quantity-btn');
    quantityBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.parentElement.querySelector('.quantity-input');
            let value = parseInt(input.value);
            const max = parseInt(input.max) || 999;
            const min = parseInt(input.min) || 1;
            
            if (this.querySelector('.fa-plus') && value < max) {
                input.value = value + 1;
            } else if (this.querySelector('.fa-minus') && value > min) {
                input.value = value - 1;
            }
        });
    });
});
</script>
@endsection