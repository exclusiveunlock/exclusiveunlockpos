<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use TomatoPHP\FilamentSettingsHub\Facades\FilamentSettingsHub;
use TomatoPHP\FilamentSettingsHub\Services\Contracts\SettingHold;
use App\Observers\FirmwareObserver;
use App\Models\Firmware;
class AppServiceProvider extends ServiceProvider
{ // app/Providers/AppServiceProvider.php

    public function register(): void
    {
        Firmware::observe(FirmwareObserver::class);

        $this->app->singleton('settings', function () {
            return cache()->remember('settings_map', 3600, function () {
                return \App\Models\Setting::all()
                    ->groupBy('name')               // agrupa por name
                    ->map(function ($rows) {
                        // Si hay múltiples filas con el mismo name, toma la última
                        $payload = $rows->last()->payload;
                        $decoded = json_decode($payload, true);

                        // Si el JSON tiene clave "value" úsala, si no el valor directo
                        if (json_last_error() === JSON_ERROR_NONE) {
                            return is_array($decoded)
                                ? ($decoded['value'] ?? $decoded)
                                : $decoded;
                        }

                        return $payload;
                    })
                    ->toArray();
            });
        });

        FilamentSettingsHub::register([
            SettingHold::make()
                ->order(10)
                ->label('Telegram')
                ->icon('heroicon-o-paper-airplane')
                ->page(\App\Filament\Pages\TelegramSettingPage::class)
                ->description('Bot Token, Chat ID, Webhook')
                ->group('Integraciones'),
        ]);
    }
}
