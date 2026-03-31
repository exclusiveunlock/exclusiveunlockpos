<?php

namespace App\Filament\Resources\Cloud\PaymentGateways\Pages;

use App\Filament\Resources\Cloud\PaymentGateways\PaymentGatewayResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePaymentGateway extends CreateRecord
{
    protected static string $resource = PaymentGatewayResource::class;
}
