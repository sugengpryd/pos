<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         if (request()->is('livewire/preview-file/*')) {
        Log::info('Livewire Preview Debug', [
            'url' => request()->url(),
            'host' => request()->getHost(),
            'scheme' => request()->getScheme(),
            'secure' => request()->isSecure(),
            'forwarded_proto' => request()->header('x-forwarded-proto'),
            'has_expires' => request()->has('expires'),
            'has_signature' => request()->has('signature'),
            'valid_signature' => request()->hasValidSignature(),
        ]);
    }
    }
}
