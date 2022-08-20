<?php

namespace App\Providers;

use App\Services\Contract\CourseServiceInterface;
use App\Services\Contract\OrderServiceInterface;
use App\Services\Implementation\CourseService;
use App\Services\Implementation\OrderService;
use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        app()->singleton(CourseServiceInterface::class, CourseService::class);
        app()->singleton(OrderServiceInterface::class, OrderService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
