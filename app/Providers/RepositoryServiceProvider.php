<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interface\TeacherRepositoryInterface;
use App\Repository\TeacherRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TeacherRepositoryInterface::class, TeacherRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
