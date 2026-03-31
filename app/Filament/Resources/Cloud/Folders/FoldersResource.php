<?php

namespace App\Filament\Resources\Cloud\Folders;

use App\Filament\Resources\Cloud\Folders\Pages\CreateFolders;
use App\Filament\Resources\Cloud\Folders\Pages\EditFolders;
use App\Filament\Resources\Cloud\Folders\Pages\ListFolders;
use App\Filament\Resources\Cloud\Folders\Schemas\FoldersForm;
use App\Filament\Resources\Cloud\Folders\Tables\FoldersTable;
use App\Models\Folder;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class FoldersResource extends Resource
{
    protected static ?string $model = Folder::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
 
    protected static string | UnitEnum | null $navigationGroup = 'Cloud';

    protected static ?int $navigationSort = 0;

    protected static ?string $slug = 'Cloud/folders';

    public static function form(Schema $schema): Schema
    {
        return FoldersForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FoldersTable::configure($table);
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
            'index' => ListFolders::route('/'),
            'create' => CreateFolders::route('/create'),
            'edit' => EditFolders::route('/{record}/edit'),
        ];
    }
}
