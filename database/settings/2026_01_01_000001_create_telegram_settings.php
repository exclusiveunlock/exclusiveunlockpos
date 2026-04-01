<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('telegram.bot_token', '');
        $this->migrator->add('telegram.chat_id', '');
        $this->migrator->add('telegram.webhook_url', null);
        $this->migrator->add('telegram.notifications_enabled', false);
    }
};