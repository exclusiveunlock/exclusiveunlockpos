<?php

namespace App\Filament\Resources\Cloud\Packages;

use App\Filament\Resources\Cloud\Packages\Pages\CreatePackages;
use App\Filament\Resources\Cloud\Packages\Pages\EditPackages;
use App\Filament\Resources\Cloud\Packages\Pages\ListPackages;
use App\Filament\Resources\Cloud\Packages\Schemas\PackagesForm;
use App\Filament\Resources\Cloud\Packages\Tables\PackagesTable;
use App\Models\Package;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
class PackagesResource extends Resource
{
    protected static ?string $model = Package::class;


protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCreditCard;
    protected static string|UnitEnum|null $navigationGroup = 'Package & Billing';
    public static function form(Schema $schema): Schema
    {
        return PackagesForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PackagesTable::configure($table);
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
            'index' => ListPackages::route('/'),
            'create' => CreatePackages::route('/create'),
            'edit' => EditPackages::route('/{record}/edit'),
        ];
    }
}
