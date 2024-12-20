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
        $this->app->singleton(
            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserEloquentRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Invoice\InvoiceRepositoryInterface::class,
            \App\Repositories\Invoice\InvoiceEloquentRepository::class
        );
        $this->app->singleton(
            \App\Repositories\SmmOrder\SmmOrderRepositoryInterface::class,
            \App\Repositories\SmmOrder\SmmOrderEloquentRepository::class
        );
        $this->app->singleton(
            \App\Repositories\SourceCodeOrder\SourceCodeOrderRepositoryInterface::class,
            \App\Repositories\SourceCodeOrder\SourceCodeOrderEloquentRepository::class
        );
        $this->app->singleton(
            \App\Repositories\SourceCodeProduct\SourceCodeProductRepositoryInterface::class,
            \App\Repositories\SourceCodeProduct\SourceCodeProductEloquentRepository::class
        );
        $this->app->singleton(
            \App\Repositories\ActivityHistory\ActivityHistoryRepositoryInterface::class,
            \App\Repositories\ActivityHistory\ActivityHistoryEloquentRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
