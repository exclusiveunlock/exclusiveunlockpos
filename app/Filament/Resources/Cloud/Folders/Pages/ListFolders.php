<?php

namespace App\Filament\Resources\Cloud\Folders\Pages;

use App\Filament\Resources\Cloud\Folders\FoldersResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFolders extends ListRecords
{
    protected static string $resource = FoldersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
