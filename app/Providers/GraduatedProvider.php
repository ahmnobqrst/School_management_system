<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interface\StudentGraduatedInterface;
use App\Repository\StudentGraduatedRepository;

class GraduatedProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(StudentGraduatedInterface::class, StudentGraduatedRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
