<?php

namespace App\Filament\Resources\Cloud\PaymentGateways\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PaymentGatewayForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('filament/cloud/payment_gateway_resource.name'))
                    ->required(),
                TextInput::make('slug')
                    ->label(__('filament/cloud/payment_gateway_resource.slug'))
                    ->required(),
                TextInput::make('type')
                    ->label(__('filament/cloud/payment_gateway_resource.type')),
                Textarea::make('description')
                    ->label(__('filament/cloud/payment_gateway_resource.description'))
                    ->columnSpanFull(),
                TextInput::make('min_amount')
                    ->label(__('filament/cloud/payment_gateway_resource.min_amount'))
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('max_amount')
                    ->label(__('filament/cloud/payment_gateway_resource.max_amount'))
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('exchange_rate')
                    ->label(__('filament/cloud/payment_gateway_resource.exchange_rate'))
                    ->required()
                    ->numeric()
                    ->default(1.0),
                TextInput::make('logo')
                    ->label(__('filament/cloud/payment_gateway_resource.logo')),
                Textarea::make('credentials')
                    ->label(__('filament/cloud/payment_gateway_resource.credentials'))
                    ->columnSpanFull(),
                Textarea::make('settings')
                    ->label(__('filament/cloud/payment_gateway_resource.settings'))
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label(__('filament/cloud/payment_gateway_resource.is_active'))
                    ->required(),
                Toggle::make('is_sandbox')
                    ->label(__('filament/cloud/payment_gateway_resource.is_sandbox'))
                    ->required(),
                TextInput::make('currency_id')
                    ->label(__('filament/cloud/payment_gateway_resource.currency_id'))
                    ->numeric(),
            ]);
    }
}
