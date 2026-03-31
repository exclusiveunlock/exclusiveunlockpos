<?php

namespace App\Filament\Resources\Cloud\Firmware\Pages;

use App\Filament\Resources\Cloud\Firmware\FirmwareResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFirmware extends EditRecord
{
    protected static string $resource = FirmwareResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
