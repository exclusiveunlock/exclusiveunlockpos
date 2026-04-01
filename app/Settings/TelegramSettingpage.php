<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class TelegramSettings extends Settings
{
    public string $bot_token;
    public string $chat_id;
    public ?string $webhook_url;
    public bool $notifications_enabled;

    public static function group(): string
    {
        return 'telegram';
    }
}