<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interface\PromotionRepositoeyInterface;
use App\Repository\PromotionRepository;

class PromotionProvidersService extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PromotionRepositoeyInterface::class, PromotionRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
