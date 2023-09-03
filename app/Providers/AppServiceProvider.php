<?php

namespace App\Providers;

use App\Imports\Stocks\ImportStocksProviderInterface;
use App\Imports\Stocks\Providers\TinkoffRestApiImportStocksProvider;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->singleton(ImportStocksProviderInterface::class, function (Application $application){
            return $application->make(TinkoffRestApiImportStocksProvider::class);
        });
    }
}
