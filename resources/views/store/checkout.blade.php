@extends('layouts.app')

@section('title', 'Checkout - GSMXSTORE')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 dark:bg-red-900/30 dark:border-red-700 dark:text-red-300">
            {{ session('error') }}
        </div>
    @endif

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white">Checkout</h1>
        <div class="mt-2 sm:mt-0 flex items-center text-sm text-gray-600 dark:text-gray-400">
            <i class="fas fa-lock mr-2 text-green-600 dark:text-green-400"></i>
            Secure Checkout
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8">
        <!-- Checkout Form -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-5 sm:p-6">
                <form action="{{ route('store.place-order') }}" method="POST">
                    @csrf
                    
                    @if(isset($directProduct))
                        <!-- Hidden input for direct product order -->
                        <input type="hidden" name="direct_product_id" value="{{ $directProduct->id }}">
                    @endif
                    
                    <div class="space-y-8">
                        <!-- Shipping Address -->
                        <div>
                            <div class="flex items-center mb-5">
                                <div class="flex-shrink-0 w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-blue-600 dark:text-blue-400 font-semibold text-sm">1</span>
                                </div>
                                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Shipping Address</h2>
                            </div>
                            
                            <!-- Existing addresses section -->
                            @if($userShippingAddresses && count($userShippingAddresses) > 0)
                                <div class="ml-11 mb-6">
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-3">Use Existing Address</h3>
                                    <div class="space-y-3">
                                        @foreach($userShippingAddresses as $address)
                                            <div class="flex items-start p-4 border border-gray-200 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-700/30">
                                                <input type="radio" name="existing_address_id" value="{{ $address->id }}" 
                                                       id="address_{{ $address->id }}" 
                                                       class="mt-1 form-radio text-blue-600 h-4 w-4" 
                                                       onchange="fillAddress({{ $loop->index }})"
                                                       @if($address->is_default) checked @endif>
                                                <label for="address_{{ $address->id }}" class="ml-3 flex-1 cursor-pointer">
                                                    <div class="flex justify-between">
                                                        <span class="font-medium text-gray-900 dark:text-white">
                                                            {{ $address->first_name }} {{ $address->last_name }}
                                                            @if($address->is_default)
                                                                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">
                                                                    Default
                                                                </span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                                        {{ $address->street_address }}, {{ $address->city }}, {{ $address->state }} {{ $address->zip_code }}
                                                    </p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-300">
                                                        Phone: {{ $address->phone_number }}
                                                    </p>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                
                                <div class="ml-11 mb-6">
                                    <div class="relative flex items-center">
                                        <div class="flex-grow border-t border-gray-300 dark:border-gray-600"></div>
                                        <div class="mx-4 text-sm text-gray-500 dark:text-gray-400">OR</div>
                                        <div class="flex-grow border-t border-gray-300 dark:border-gray-600"></div>
                                    </div>
                                </div>
                            @endif
                            
                            <!-- New address form -->
                            <div class="ml-11">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Enter New Address</h3>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    <div class="sm:col-span-1">
                                        <label for="first_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">First Name</label>
                                        <input type="text" name="first_name" id="first_name" required class="mt-1 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    </div>
                                    <div class="sm:col-span-1">
                                        <label for="last_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Last Name</label>
                                        <input type="text" name="last_name" id="last_name" required class="mt-1 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="street_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Street Address</label>
                                        <input type="text" name="street_address" id="street_address" required class="mt-1 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    </div>
                                    <div class="sm:col-span-1">
                                        <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-300">City</label>
                                        <input type="text" name="city" id="city" required class="mt-1 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    </div>
                                    <div class="sm:col-span-1">
                                        <label for="state" class="block text-sm font-medium text-gray-700 dark:text-gray-300">State</label>
                                        <input type="text" name="state" id="state" required class="mt-1 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    </div>
                                    <div class="sm:col-span-1">
                                        <label for="zip_code" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Zip Code</label>
                                        <input type="text" name="zip_code" id="zip_code" required class="mt-1 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    </div>
                                    <div class="sm:col-span-1">
                                        <label for="phone_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone Number</label>
                                        <input type="text" name="phone_number" id="phone_number" required class="mt-1 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="extra_note" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Extra Note</label>
                                        <textarea name="extra_note" id="extra_note" rows="3" class="mt-1 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"></textarea>
                                    </div>
                                </div>
                                
                                <!-- Save as default address option -->
                                <div class="mt-4">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="save_as_default" value="1" class="form-checkbox text-blue-600 h-4 w-4">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Save this address as my default shipping address</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- JavaScript for address selection -->
                        <script>
                            // Array of addresses to be used for filling the form
                            var addresses = [
                                @foreach($userShippingAddresses as $address)
                                    {
                                        first_name: "{{ addslashes($address->first_name) }}",
                                        last_name: "{{ addslashes($address->last_name) }}",
                                        street_address: "{{ addslashes($address->street_address) }}",
                                        city: "{{ addslashes($address->city) }}",
                                        state: "{{ addslashes($address->state) }}",
                                        zip_code: "{{ addslashes($address->zip_code) }}",
                                        phone_number: "{{ addslashes($address->phone_number) }}",
                                        extra_note: "{{ addslashes($address->extra_note ?? '') }}"
                                    }@if(!$loop->last),@endif
                                @endforeach
                            ];
                            
                            function fillAddress(index) {
                                if (addresses[index]) {
                                    document.getElementById('first_name').value = addresses[index].first_name;
                                    document.getElementById('last_name').value = addresses[index].last_name;
                                    document.getElementById('street_address').value = addresses[index].street_address;
                                    document.getElementById('city').value = addresses[index].city;
                                    document.getElementById('state').value = addresses[index].state;
                                    document.getElementById('zip_code').value = addresses[index].zip_code;
                                    document.getElementById('phone_number').value = addresses[index].phone_number;
                                    document.getElementById('extra_note').value = addresses[index].extra_note;
                                }
                            }
                            
                            // Handle radio button selection for existing addresses
                            document.addEventListener('DOMContentLoaded', function() {
                                const existingAddressRadios = document.querySelectorAll('input[name="existing_address_id"]');
                                existingAddressRadios.forEach(function(radio) {
                                    radio.addEventListener('change', function() {
                                        if (this.checked) {
                                            const index = Array.from(existingAddressRadios).indexOf(this);
                                            fillAddress(index);
                                        }
                                    });
                                });
                                
                                // Auto-fill with default address if available
                                const defaultAddressRadio = document.querySelector('input[name="existing_address_id"]:checked');
                                if (defaultAddressRadio) {
                                    const index = Array.from(existingAddressRadios).indexOf(defaultAddressRadio);
                                    fillAddress(index);
                                }
                            });
                        </script>
                        
                        <!-- Billing Address -->
                        <div>
                            <div class="flex items-center mb-5">
                                <div class="flex-shrink-0 w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-blue-600 dark:text-blue-400 font-semibold text-sm">2</span>
                                </div>
                                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Billing Address</h2>
                            </div>
                            
                            <div class="ml-11">
                                <textarea name="billing_address" required placeholder="Enter your billing address" 
                                          class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">{{ auth()->user()->address ?? '' }}</textarea>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">This address will appear on your invoice</p>
                            </div>
                        </div>
                        
                        <!-- Payment Method -->
                        <div>
                            <div class="flex items-center mb-5">
                                <div class="flex-shrink-0 w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-blue-600 dark:text-blue-400 font-semibold text-sm">3</span>
                                </div>
                                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Payment Method</h2>
                            </div>
                            
                            <div class="ml-11">
                                <div class="space-y-4">
                                    @forelse($activePaymentGateways ?? collect() as $gateway)
                                        @if($gateway->type !== 'offline')
                                            <label class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 cursor-pointer transition-colors">
                                                <input type="radio" name="payment_method" value="{{ $gateway->type }}" class="form-radio text-blue-600 h-5 w-5" required>
                                                <div class="ml-4 flex items-center">
                                                    <div class="w-10 h-10 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center mr-3">
                                                        <i class="fas fa-credit-card text-gray-600 dark:text-gray-300"></i>
                                                    </div>
                                                    <span class="text-gray-700 dark:text-gray-300 font-medium">{{ $gateway->name }}</span>
                                                </div>
                                            </label>
                                        @endif
                                    @empty
                                        <div class="p-4 bg-red-50 dark:bg-red-900/20 rounded-lg">
                                            <p class="text-red-700 dark:text-red-300">
                                                <i class="fas fa-exclamation-circle mr-2"></i>
                                                No payment methods available. Please contact admin.
                                            </p>
                                        </div>
                                    @endforelse
                                    
                                    <!-- Cash on Delivery option -->
            @if(isset($cartItems) && count($cartItems) > 0)
                @php
                    $showCOD = true;
                    foreach($cartItems as $item) {
                        if(isset($item['product']) && !$item['product']->is_cod_available) {
                            $showCOD = false;
                            break;
                        }
                    }
                @endphp
                @if($showCOD)
                    <label class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 cursor-pointer transition-colors">
                        <input type="radio" name="payment_method" value="cod" class="form-radio text-blue-600 h-5 w-5" required>
                        <div class="ml-4 flex items-center">
                            <div class="w-10 h-10 bg-green-100 dark:bg-green-900/20 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-money-bill-wave text-green-600 dark:text-green-400"></i>
                            </div>
                            <span class="text-gray-700 dark:text-gray-300 font-medium">Cash on Delivery</span>
                        </div>
                    </label>
                @endif
            @elseif(isset($directProduct) && $directProduct->is_cod_available)
                <label class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 cursor-pointer transition-colors">
                    <input type="radio" name="payment_method" value="cod" class="form-radio text-blue-600 h-5 w-5" required>
                    <div class="ml-4 flex items-center">
                        <div class="w-10 h-10 bg-green-100 dark:bg-green-900/20 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-money-bill-wave text-green-600 dark:text-green-400"></i>
                        </div>
                        <span class="text-gray-700 dark:text-gray-300 font-medium">Cash on Delivery</span>
                    </div>
                </label>
            @elseif(!isset($cartItems) && !isset($directProduct))
                @if($activePaymentGateways->contains('code', 'cod'))
                    <label class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 cursor-pointer transition-colors">
                        <input type="radio" name="payment_method" value="cod" class="form-radio text-blue-600 h-5 w-5" required>
                        <div class="ml-4 flex items-center">
                            <div class="w-10 h-10 bg-green-100 dark:bg-green-900/20 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-money-bill-wave text-green-600 dark:text-green-400"></i>
                            </div>
                            <span class="text-gray-700 dark:text-gray-300 font-medium">Cash on Delivery</span>
                        </div>
                    </label>
                @endif
            @endif
                                    
                                                                    </div>
                            </div>
                        </div>
                        
                        <!-- Additional Notes -->
                        <div>
                            <div class="flex items-center mb-5">
                                <div class="flex-shrink-0 w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-blue-600 dark:text-blue-400 font-semibold text-sm">4</span>
                                </div>
                                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Additional Notes</h2>
                            </div>
                            
                            <div class="ml-11">
                                <textarea name="notes" placeholder="Any additional notes for your order (e.g., delivery instructions)" 
                                          class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors h-24"></textarea>
                            </div>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 px-6 rounded-lg font-semibold text-lg transition-colors duration-200 flex items-center justify-center">
                                <i class="fas fa-shopping-bag mr-3"></i> Place Order
                            </button>
                            
                            <div class="mt-4 text-center">
                                <a href="{{ route('store.cart') }}" class="text-blue-600 dark:text-blue-400 hover:underline text-sm">
                                    <i class="fas fa-arrow-left mr-2"></i> Back to Cart
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Order Summary Sidebar -->
        <div>
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-5 sm:p-6 sticky top-24">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                    <i class="fas fa-receipt mr-2 text-blue-600 dark:text-blue-400"></i> Order Summary
                </h3>
                
                <div class="space-y-4 mb-6">
                    @foreach($cartItems as $item)
                        <div class="flex items-center pb-4 border-b border-gray-200 dark:border-gray-700">
                            @if($item['product']->thumbnail)
                                <img src="{{ asset('uploads/' . $item['product']->thumbnail) }}" alt="{{ $item['product']->title }}" class="w-14 h-14 sm:w-16 sm:h-16 object-cover rounded-lg">
                            @else
                                <div class="w-14 h-14 sm:w-16 sm:h-16 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400"></i>
                                </div>
                            @endif
                            
                            <div class="flex-1 ml-3 sm:ml-4">
                                <h4 class="font-medium text-gray-900 dark:text-white line-clamp-1 text-sm sm:text-base">{{ $item['product']->title }}</h4>
                                <p class="text-gray-600 dark:text-gray-400 text-xs sm:text-sm mt-1">
                                    @currency($item['price']) × {{ $item['quantity'] }}
                                </p>
                            </div>
                            
                            <div class="text-right">
                                <p class="font-semibold text-gray-900 dark:text-white text-sm sm:text-base">
                                    @currency($item['subtotal'])
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="space-y-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-300">Subtotal</span>
                        <span class="text-gray-900 dark:text-white">@currency($total)</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-300">Delivery</span>
                        <span class="text-green-600 dark:text-green-400 flex items-center">
                            <i class="fas fa-check-circle mr-1"></i> Free
                        </span>
                    </div>
                    <div class="flex justify-between text-lg font-bold pt-3 border-t border-gray-200 dark:border-gray-700">
                        <span class="text-gray-900 dark:text-white">Total</span>
                        <span class="text-blue-600 dark:text-blue-400">@currency($total)</span>
                    </div>
                </div>
                
                <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                    <div class="flex items-start">
                        <i class="fas fa-shield-alt text-blue-600 dark:text-blue-400 mt-0.5 mr-2"></i>
                        <div>
                            <h4 class="font-semibold text-blue-800 dark:text-blue-200 text-sm">Secure Payment</h4>
                            <p class="text-blue-700 dark:text-blue-300 text-xs mt-1">Your payment information is encrypted and secure.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection