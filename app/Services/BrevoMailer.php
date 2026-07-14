<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BrevoMailer
{
    /**
     * @return array{status: string, error: string|null}
     */
    public static function send(string $toEmail, string $toName, string $subject, string $html): array
    {
        try {
            $response = Http::withHeaders([
                'api-key'      => config('services.brevo.key'),
                'Content-Type' => 'application/json',
            ])->post('https://api.brevo.com/v3/smtp/email', [
                'sender' => [
                    'name'  => 'Malaysian Forestry Conference 2026',
                    'email' => 'noreply@mfc2026.com',
                ],
                'to' => [[
                    'email' => $toEmail,
                    'name'  => $toName,
                ]],
                'subject'     => $subject,
                'htmlContent' => $html,
            ]);

            if ($response->failed()) {
                return ['status' => 'failed', 'error' => 'Brevo ' . $response->status() . ': ' . $response->body()];
            }

            return ['status' => 'sent', 'error' => null];
        } catch (\Exception $e) {
            return ['status' => 'failed', 'error' => $e->getMessage()];
        }
    }
}