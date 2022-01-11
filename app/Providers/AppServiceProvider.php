<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Model\Entity\Product\Contract\IFind;
use Src\Model\Repository\Product\FindRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            IFind::class,
            FindRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
