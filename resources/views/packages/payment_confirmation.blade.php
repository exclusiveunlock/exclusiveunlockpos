{{-- resources/views/packages/payment_confirmation.blade.php --}}
@extends('layouts.app')

@section('title', 'Payment Confirmation')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Confirm Your Payment</h1>

        {{-- Package Summary --}}
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-2">Package Details</h2>
            <ul class="text-gray-600 dark:text-gray-400">
                <li><strong>Package:</strong> {{ $package->name }}</li>
                <li><strong>Price:</strong> {{ number_format($paymentDetails['final_price'], 2) }} {{ $package->currency ?? 'USD' }}</li>
                @if($paymentDetails['coupon_code'])
                    <li><strong>Coupon Applied:</strong> {{ $paymentDetails['coupon_code'] }}</li>
                @endif
                <li><strong>Payment Method:</strong> {{ $paymentGateway->name }}</li>
            </ul>
        </div>

        {{-- Gateway Specific Instructions --}}
        @if ($paymentGateway->type === 'bkash')
            <div class="bg-purple-100 dark:bg-purple-900 text-purple-900 dark:text-purple-100 p-4 rounded mb-6">
                <h3 class="font-semibold text-lg mb-2">bKash Payment Instructions</h3>
                <p>
                    Please send <strong>{{ number_format($paymentDetails['final_price'], 2) }} {{ $package->currency ?? 'USD' }}</strong>
                    to this bKash Number: <strong>{{ $paymentGateway->account_number }}</strong>.
                </p>
                <p class="mt-2 text-sm">After payment, provide the transaction ID to confirm.</p>
            </div>
        @elseif ($paymentGateway->type === 'binance_c2c')
            <div class="bg-yellow-100 dark:bg-yellow-900 text-yellow-900 dark:text-yellow-100 p-4 rounded mb-6">
                <h3 class="font-semibold text-lg mb-2">Binance C2C Instructions</h3>
                <p>
                    <p>Please send {{ $package->currency->symbol ?? '
                </p>
                <p class="mt-2 text-sm">After payment, take a screenshot and submit it to our support team.</p>
            </div>
        @else
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <strong>Error:</strong> Unsupported payment gateway.
            </div>
        @endif

        {{-- Confirmation Form --}}
        <form method="POST" action="{{ route('packages.processPayment') }}">
            @csrf
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded transition duration-200">
                    Confirm Payment
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
 }}{{ number_format($paymentDetails['final_price'], 2) }} to the following Binance ID:</p>
                </p>
                <p class="mt-2 text-sm">After payment, take a screenshot and submit it to our support team.</p>
            </div>
        @else
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <strong>Error:</strong> Unsupported payment gateway.
            </div>
        @endif

        {{-- Confirmation Form --}}
        <form method="POST" action="{{ route('packages.processPayment') }}">
            @csrf
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded transition duration-200">
                    Confirm Payment
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
