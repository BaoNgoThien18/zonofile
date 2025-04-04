<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Setting;

class TelegramController extends Controller
{
    public function send($text)
    {
        $botToken = Setting::where('name', 'telegram_token')->first()->value ?? env('TELEGRAM_TOKEN');
        $chatId = Setting::where('name', 'telegram_chat_id')->first()->value ?? env('TELEGRAM_CHATID');
        
        $response = Http::post("https://api.telegram.org/bot{$botToken}/sendMessage", [
            'chat_id' => $chatId,
            'text' => $text,
        ]);

        if ($response->successful()) {
            return "Message sent successfully.";
        } else {
            return "Failed to send message.ngobaovippro";
        }
    }
}
