<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interface\StudentRepositoryInterface;
use App\Repository\StudentRepository;

class StudentProvidores extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
