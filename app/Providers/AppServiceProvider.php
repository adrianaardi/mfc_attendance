<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        $this->app->resolving('mail.manager', function ($mailManager) {
            $mailManager->extend('brevo', function () {
                return new \App\Mail\BrevoTransport(config('services.brevo.key'));
            });
        });
    }
}