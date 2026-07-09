<?php

namespace App\Mail;

use Illuminate\Support\Facades\Http;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mailer\Transport\AbstractTransport;
use Symfony\Component\Mime\MessageConverter;

class BrevoTransport extends AbstractTransport
{
    protected string $apiKey;

    public function __construct(string $apiKey)
    {
        parent::__construct();
        $this->apiKey = $apiKey;
    }

    protected function doSend(SentMessage $message): void
    {
        $email = MessageConverter::toEmail($message->getOriginalMessage());

        $response = Http::withHeaders([
            'api-key' => $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post('https://api.brevo.com/v3/smtp/email', [
            'sender' => [
                'name'  => $email->getFrom()[0]->getName(),
                'email' => $email->getFrom()[0]->getAddress(),
            ],
            'to' => array_map(fn($addr) => [
                'email' => $addr->getAddress(),
                'name'  => $addr->getName(),
            ], $email->getTo()),
            'subject'     => $email->getSubject(),
            'htmlContent' => $email->getHtmlBody(),
            'textContent' => $email->getTextBody(),
        ]);

        if ($response->failed()) {
            throw new \RuntimeException('Brevo API error ' . $response->status() . ': ' . $response->body());
        }
    }

    public function __toString(): string
    {
        return 'brevo';
    }
}