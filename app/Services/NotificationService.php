<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    public function notify($user, $transfer)
    {
        try{
            $response = Http::post('https://util.devi.tools/api/v1/notify', [
                'email' => $user->email,
                'message' => "Transfer of {$transfer->value} received from {$transfer->payer->name}.",
            ]);

            if ($response->failed()) {
                Log::error('Notification failed for user: ' . $user->id);
            }
        } catch (\Exception $e) {
            Log::error('Notification error: ' . $e->getMessage());
        }
    }
}