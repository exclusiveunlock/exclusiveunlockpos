<?php

namespace App\Observers;

use App\Models\Firmware;
use App\Services\TelegramService;

class FirmwareObserver
{
    public function created(Firmware $firmware): void
    {
        $type   = strtoupper($firmware->type ?? 'free');
        $folder = optional($firmware->folder)->name ?? 'Sin carpeta';
        $url    = url('firmware/' . $firmware->name);

        $message = "📢 *New Firmware Update*\n\n"
            . "✅ *Name:* {$firmware->name}\n"
            . "📁 *Folder:* {$folder}\n"
            . "⚙️ *Type:* {$type}\n"
            . "🔗 [View Firmware]({$url})";

        app(TelegramService::class)->send($message);
    }
}