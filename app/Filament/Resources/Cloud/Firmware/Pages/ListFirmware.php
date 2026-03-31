<?php

namespace App\Filament\Resources\Cloud\Firmware\Pages;

use App\Filament\Resources\Cloud\Firmware\FirmwareResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFirmware extends ListRecords
{
    protected static string $resource = FirmwareResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
