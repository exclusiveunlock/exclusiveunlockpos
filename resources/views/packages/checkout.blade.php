<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-semibold mb-4">Package Details: {{ $package->title }}</h3>

                    <div class="mb-6">
                        <p><strong>Price:</strong> {{ $package->currency->symbol ?? '' }}{{ $package->price }}</p>
                        <p><strong>Duration:</strong> {{ $package->duration }}</p>
                        <p><strong>Bandwidth:</strong> {{ $package->bandwidth }}GB</p>
                        <p><strong>Files:</strong> {{ $package->files }}</p>
                    </div>

                    <form x-data="{ selectedGateway: null, gateways: {{ json_encode($paymentGateways) }} }" action="{{ route('packages.process-payment', $package) }}" method="POST">
                        @csrf

                        @if ($errors->any())
                            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mb-4">
                            <label for="payment_gateway_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Select Payment Method</label>
                            <select name="payment_gateway_id" id="payment_gateway_id" x-model="selectedGateway" class="mt-1 block w-full px-4 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-200">
                                <option value="">-- Select --</option>
                                @foreach ($paymentGateways as $gateway)
                                    <option value="{{ $gateway->id }}">{{ $gateway->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="coupon_code" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Coupon Code (Optional)</label>
                            <input type="text" name="coupon_code" id="coupon_code" placeholder="Enter coupon code" class="mt-1 block w-full px-4 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <button type="submit" class="inline-block bg-green-500 text-white px-6 py-3 rounded-lg font-semibold">Proceed to Pay</button>

                        <!-- Binance C2C Details Section -->
                        <template x-if="selectedGateway && gateways.find(g => g.id == selectedGateway && g.type === 'binance_c2c')">
                            <div class="mt-6 p-6 bg-gray-100 dark:bg-gray-700 rounded-lg shadow-md">
                                <h4 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Binance C2C Payment Instructions</h4>
                                <div x-data="{ currentGateway: gateways.find(g => g.id == selectedGateway) }">
                                    <template x-if="currentGateway && currentGateway.credentials.qr_code_image">
                                        <div class="mb-4 text-center">
                                            <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">Scan the QR code to pay:</p>
                                            <img :src="'/storage/' + currentGateway.credentials.qr_code_image" alt="QR Code" class="mx-auto w-48 h-48 object-contain border border-gray-300 dark:border-gray-600 rounded-lg p-2">
                                        </div>
                                    </template>
                                    <template x-if="currentGateway && currentGateway.credentials.payment_instructions">
                                        <div class="mb-4">
                                            <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">Payment Instructions:</p>
                                            <div x-html="currentGateway.credentials.payment_instructions" class="prose dark:prose-invert max-w-none text-gray-800 dark:text-gray-200"></div>
                                        </div>
                                    </template>
                                    <div class="mb-4">
                                        <label for="transaction_note" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Your Transaction ID / Note</label>
                                        <input type="text" name="transaction_note" id="transaction_note" placeholder="Enter your transaction ID or note" class="mt-1 block w-full px-4 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-200">
                                    </div>
                                    <button type="submit" formaction="{{ route('packages.verify-binance-c2c', $package) }}" class="inline-block bg-blue-500 text-white px-6 py-3 rounded-lg font-semibold">Verify Payment</button>
                                </div>
                            </div>
                        </template>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
