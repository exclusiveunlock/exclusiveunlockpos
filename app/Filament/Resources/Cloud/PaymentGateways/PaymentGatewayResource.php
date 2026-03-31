<?php

namespace App\Filament\Resources\Cloud\PaymentGateways;

use App\Filament\Resources\Cloud\PaymentGateways\Pages\CreatePaymentGateway;
use App\Filament\Resources\Cloud\PaymentGateways\Pages\EditPaymentGateway;
use App\Filament\Resources\Cloud\PaymentGateways\Pages\ListPaymentGateways;
use App\Filament\Resources\Cloud\PaymentGateways\Schemas\PaymentGatewayForm;
use App\Filament\Resources\Cloud\PaymentGateways\Tables\PaymentGatewaysTable;
use App\Models\PaymentGateway;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PaymentGatewayResource extends Resource
{
    protected static ?string $model = PaymentGateway::class;

    protected static ?string $pluralModelLabel = null;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string|UnitEnum|null $navigationGroup = 'Package & Billing';
    public static function form(Schema $schema): Schema
    {
        return PaymentGatewayForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PaymentGatewaysTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPaymentGateways::route('/'),
            'create' => CreatePaymentGateway::route('/create'),
            'edit' => EditPaymentGateway::route('/{record}/edit'),
        ];
    }
}
