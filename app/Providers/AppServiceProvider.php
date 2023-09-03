<?php

namespace App\Providers;

use App\GetDividends\GetDividendsHandlerInterface;
use App\GetDividends\Handlers\TinkoffRestApiGetDividendsHandler;
use App\Imports\Brands\ImportBrandsProviderInterface;
use App\Imports\Brands\Providers\TinkoffRestApiImportBrandsProvider;
use App\Imports\Stocks\ImportStocksProviderInterface;
use App\Imports\Stocks\Providers\TinkoffRestApiImportStocksProvider;
use Illuminate\Foundation\Application;
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
        $this->app->singleton(ImportStocksProviderInterface::class, function (Application $application) {
            // Использование тиньков провайдера
            return $application->make(TinkoffRestApiImportStocksProvider::class);
        });

        $this->app->singleton(ImportBrandsProviderInterface::class, function (Application $application) {
            // Использование тиньков провайдера
            return $application->make(TinkoffRestApiImportBrandsProvider::class);
        });

        $this->app->singleton(GetDividendsHandlerInterface::class, function (Application $application) {
            // Использование тиньков провайдера
            return $application->make(TinkoffRestApiGetDividendsHandler::class);
        });
    }
}
