<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

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

        if ($this->app->environment('production')) {
        URL::forceScheme('https');
                }

         if (request()->is('livewire/preview-file/*')) {
        Log::info('LIVEWIRE PREVIEW DEBUG', [
            'full_url' => request()->fullUrl(),
            'query_string' => request()->server('QUERY_STRING'),
            'raw_query' => request()->getQueryString(),

            'expires' => request()->query('expires'),
            'has_signature' => request()->query('signature') !== null,

            'query_parameters' => array_keys(request()->query()),

            'host' => request()->getHost(),
            'scheme' => request()->getScheme(),
            'secure' => request()->isSecure(),

            'valid_signature' => request()->hasValidSignature(),
        ]);
                }

    }
}
