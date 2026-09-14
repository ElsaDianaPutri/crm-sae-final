<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    public function sendOtp(string $phone, string $otp): void
{
    if (app()->environment('local')) {
        Log::info('SAE CAFE WHATSAPP OTP', [
            'phone' => $phone,
            'otp' => $otp,
        ]);

        return;
    }

    // Production:
    // Kirim OTP melalui provider WhatsApp resmi.
}

    public function sendWelcome(string $phone, string $memberName, string $memberUrl): void
    {
        Log::info('SAE CAFE WHATSAPP WELCOME', [
            'phone' => $phone,
            'name' => $memberName,
            'member_url' => $memberUrl,
        ]);
    }
}