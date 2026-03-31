<?php

namespace App\Filament\Resources\Cloud\Firmware;

use App\Filament\Resources\Cloud\Firmware\Pages\CreateFirmware;
use App\Filament\Resources\Cloud\Firmware\Pages\EditFirmware;
use App\Filament\Resources\Cloud\Firmware\Pages\ListFirmware;
use App\Filament\Resources\Cloud\Firmware\Schemas\FirmwareForm;
use App\Filament\Resources\Cloud\Firmware\Tables\FirmwareTable;
use App\Models\Firmware;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use App\Filament\Resources\Cloud\Firmware\Widgets\FirmwareStats;
class FirmwareResource extends Resource
{
    protected static ?string $model = Firmware::class;

 
 protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCpuChip;
    protected static string | UnitEnum | null $navigationGroup = 'Cloud';

    protected static ?int $navigationSort = 1;

    protected static ?string $slug = 'Cloud/firmware';

    public static function form(Schema $schema): Schema
    {
        return FirmwareForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FirmwareTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }
 public static function getWidgets(): array
    {
        return [
            FirmwareStats::class,
        ];
    }
    public static function getPages(): array
    {
        return [
            'index' => ListFirmware::route('/'),
            'create' => CreateFirmware::route('/create'),
            'edit' => EditFirmware::route('/{record}/edit'),
        ];
    }
     
}
