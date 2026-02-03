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
        if (env('DEMO_MODE', false)) {
            $this->app->bind(
                \App\Services\AiReviewService::class,
                \App\Services\MockAiReviewService::class
            );
        } else {
            $this->app->bind(
                \App\Services\AiReviewService::class,
                \App\Services\OpenAiReviewService::class
            );
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
