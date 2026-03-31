<?php

namespace App\Filament\Resources\Cloud\Packages\Pages;

use App\Filament\Resources\Cloud\Packages\PackagesResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPackages extends EditRecord
{
    protected static string $resource = PackagesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
