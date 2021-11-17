<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Department\DepartmentRepositoryInterface::class,
            \App\Repositories\Department\DepartmentRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Room\RoomRepositoryInterface::class,
            \App\Repositories\Room\RoomRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Booking\BookingRepositoryInterface::class,
            \App\Repositories\Booking\BookingRepository::class
        );

        $this->app->singleton(
            \App\Repositories\FromTo\FromToRepositoryInterface::class,
            \App\Repositories\FromTo\FromToRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
