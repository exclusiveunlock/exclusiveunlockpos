<?php

namespace App\Filament\Resources\Cloud\Folders\Pages;

use App\Filament\Resources\Cloud\Folders\FoldersResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFolders extends EditRecord
{
    protected static string $resource = FoldersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
