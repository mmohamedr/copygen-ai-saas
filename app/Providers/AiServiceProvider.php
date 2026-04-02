<?php

namespace App\Providers;

use App\Contracts\AiGeneratorInterface;
use App\Services\AiGeneratorService;
use Illuminate\Support\ServiceProvider;

class AiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AiGeneratorInterface::class, function ($app) {
            // Swappable point: Return RealOpenAiService::class here later!
            return new AiGeneratorService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
