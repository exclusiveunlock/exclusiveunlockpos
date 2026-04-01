<?php

namespace App\Filament\Pages;

use App\Settings\TelegramSettings;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Http;
use UnitEnum;

use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;
use BackedEnum;

class TelegramSettingPage extends SettingsPage
{
    protected static string $settings = TelegramSettings::class;


    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Telegram';

    protected static string | UnitEnum | null $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 20;

    protected static ?string $title = 'Configuración de Telegram';
     public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public function form(Schema $form): Schema
    {
        return $form
            ->schema([
                Section::make('Credenciales del Bot')
                    ->description('Configura las credenciales de tu bot de Telegram.')
                    ->icon('heroicon-o-key')
                    ->schema([
                        Forms\Components\TextInput::make('bot_token')
                            ->label('Bot Token')
                            ->placeholder('1234567890:ABCDefGhIJKlmNoPQRsTUVwxyZ')
                            ->password()
                            ->revealable()
                            ->required()
                            ->maxLength(500)
                            ->helperText('Obténlo hablando con @BotFather en Telegram.')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('chat_id')
                            ->label('Chat ID')
                            ->placeholder('-1001234567890')
                            ->required()
                            ->maxLength(255)
                            ->helperText('ID del chat o canal donde se enviarán las notificaciones.')
                            ->columnSpan(1),

                        Forms\Components\TextInput::make('webhook_url')
                            ->label('Webhook URL')
                            ->placeholder('https://tu-dominio.com/webhook/telegram')
                            ->url()
                            ->nullable()
                            ->maxLength(500)
                            ->helperText('Opcional. URL para recibir actualizaciones vía webhook.')
                            ->columnSpan(1),
                    ])
                    ->columns(2),

                Section::make('Notificaciones')
                    ->description('Controla el envío de notificaciones a través de Telegram.')
                    ->icon('heroicon-o-bell')
                    ->schema([
                        Forms\Components\Toggle::make('notifications_enabled')
                            ->label('Activar notificaciones')
                            ->helperText('Habilita o deshabilita el envío de notificaciones por Telegram.')
                            ->onColor('success')
                            ->offColor('danger')
                            ->inline(false),
                    ]),

                Section::make('Prueba de conexión')
                    ->description('Envía un mensaje de prueba para verificar que la configuración es correcta.')
                    ->icon('heroicon-o-signal')
                    ->schema([
                     
                            Action::make('test_connection')
                                ->label('Enviar mensaje de prueba')
                                ->icon('heroicon-o-paper-airplane')
                                ->color('info')
                                ->action('testConnection'),
                        
                    ]),
            ]);
    }

    public function testConnection(): void
    {
        /** @var TelegramSettings $settings */
        $settings = app(TelegramSettings::class);

        if (empty($settings->bot_token) || empty($settings->chat_id)) {
            Notification::make()
                ->title('Faltan datos')
                ->body('Guarda primero el Bot Token y el Chat ID antes de probar.')
                ->warning()
                ->send();

            return;
        }

        try {
            $response = Http::post(
                "https://api.telegram.org/bot{$settings->bot_token}/sendMessage",
                [
                    'chat_id'    => $settings->chat_id,
                    'text'       => '✅ Conexión exitosa desde *' . config('app.name') . '*',
                    'parse_mode' => 'Markdown',
                ]
            );

            if ($response->successful() && $response->json('ok')) {
                Notification::make()
                    ->title('¡Conexión exitosa!')
                    ->body('El mensaje de prueba fue enviado correctamente a Telegram.')
                    ->success()
                    ->send();
            } else {
                Notification::make()
                    ->title('Error al enviar')
                    ->body($response->json('description') ?? 'Respuesta inesperada de la API.')
                    ->danger()
                    ->send();
            }
        } catch (\Exception $e) {
            Notification::make()
                ->title('Error inesperado')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }
}