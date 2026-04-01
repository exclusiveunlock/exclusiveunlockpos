<?php

namespace App\Services;

use App\Settings\TelegramSettings;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramService
{
    protected string $botToken;
    protected string $chatId;
    protected bool $enabled;

    public function __construct()
    {
        $settings = app(TelegramSettings::class);

        $this->botToken = $settings->bot_token;
        $this->chatId   = $settings->chat_id;
        $this->enabled  = $settings->notifications_enabled;
    }

    public function send(string $message): bool
    {
        if (! $this->enabled || empty($this->botToken) || empty($this->chatId)) {
            return false;
        }

        try {
            $response = Http::post(
                "https://api.telegram.org/bot{$this->botToken}/sendMessage",
                [
                    'chat_id'                  => $this->chatId,
                    'text'                     => $message,
                    'parse_mode'               => 'Markdown',
                    'disable_web_page_preview' => true,
                ]
            );

            return $response->successful() && $response->json('ok');
        } catch (\Exception $e) {
            Log::error('Telegram notification failed: ' . $e->getMessage());
            return false;
        }
    }
}