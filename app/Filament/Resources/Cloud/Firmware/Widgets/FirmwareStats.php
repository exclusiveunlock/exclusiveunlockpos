<?php

namespace App\Filament\Resources\Cloud\Firmware\Widgets;

use App\Filament\Resources\Cloud\Firmware\Pages\ListFirmware;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FirmwareStats extends BaseWidget
{
    use InteractsWithPageTable;

    protected ?string $pollingInterval = null;

    protected function getTablePage(): string
    {
        return ListFirmware::class;
    }

    protected function getStats(): array
    {
        $query = $this->getPageTableQuery();
        
        return [
            Stat::make('Total Firmware', $query->count()),
            Stat::make('Firmware Inventory', $query->sum('qty')),
            Stat::make('Average price', '$' . number_format((float) $query->avg('price'), 2)),
        ];
    }
}