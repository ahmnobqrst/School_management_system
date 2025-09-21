<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interface\FeesRepositoryInterface;
use App\Repository\FeesRepository;
use App\Interface\FeeinvoiceRepositoryInterface;
use App\Repository\FeeinvoiceRepository;
use App\Interface\RecieptRepositoryInterface;
use App\Repository\RecieptRepository;
use App\Interface\processingFeeRepositoryInterface;
use App\Repository\processingFeeRepository;
use App\Interface\PaymentRepositoryInterface;
use App\Repository\PaymentRespository;
use App\Interface\AttendenceRepositoryInterface;
use App\Repository\AttendenceRepository;
use App\Interface\SubjectRepositoryInterface;
use App\Repository\SubjectRepository;
use App\Interface\QuizzesInterface;
use App\Interface\QuestionsInterface;
use App\Repository\QuizzesRepository;
use App\Repository\QuestionRepository;
use App\Interface\OnlineClasses;
use App\Repository\OnlineClassesRepository;
use App\Interface\LiberaryInterface;
use App\Repository\LiberaryRepository;
use App\Interface\SettingInterface;
use App\Repository\SettingRepository;

class FeesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(FeesRepositoryInterface::class, FeesRepository::class);
        $this->app->bind(FeeinvoiceRepositoryInterface::class, FeeinvoiceRepository::class);
        $this->app->bind(RecieptRepositoryInterface::class, RecieptRepository::class);
        $this->app->bind(processingFeeRepositoryInterface::class, processingFeeRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRespository::class);
        $this->app->bind(AttendenceRepositoryInterface::class, AttendenceRepository::class);
        $this->app->bind(SubjectRepositoryInterface::class, SubjectRepository::class);
        $this->app->bind(QuizzesInterface::class, QuizzesRepository::class);
        $this->app->bind(QuestionsInterface::class, QuestionRepository::class);
        $this->app->bind(OnlineClasses::class, OnlineClassesRepository::class);
        $this->app->bind(LiberaryInterface::class, LiberaryRepository::class);
        $this->app->bind(SettingInterface::class, SettingRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
