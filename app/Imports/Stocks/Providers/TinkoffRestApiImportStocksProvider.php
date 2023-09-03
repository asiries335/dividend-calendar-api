<?php

namespace App\Imports\Stocks\Providers;

use App\Components\Stocks\Handlers\DTO\SaveStockDto;
use App\Enums\StockProviderEnum;
use App\Imports\Stocks\ImportStocksProviderInterface;
use App\Jobs\SaveStockJob;
use Carbon\Carbon;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class TinkoffRestApiImportStocksProvider implements ImportStocksProviderInterface
{
    private Http $http;
    private Config $config;
    private Dispatcher $dispatcher;

    /**
     * @param Http $http
     * @param Config $config
     * @param Dispatcher $dispatcher
     */
    public function __construct(Http $http, Config $config, Dispatcher $dispatcher)
    {
        $this->http = $http;
        $this->config = $config;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @return bool
     */
    public function asyncHandle(): bool
    {
        $token = $this->config::get('services.tinkoff.token');

        $response = $this->http::withToken(
            $token
        )->post('https://invest-public-api.tinkoff.ru/rest/tinkoff.public.invest.api.contract.v1.InstrumentsService/Shares', [
            'req' => 1
        ]);

        foreach ($response->json()['instruments'] as $stock) {
            $dto = new SaveStockDto(
                $stock['figi'],
                $stock['ticker'],
                $stock['classCode'],
                $stock['isin'],
                $stock['currency'],
                $stock['name'],
                $stock['exchange'],
                $stock['sector'],
                $stock['countryOfRisk'],
                Carbon::now(),
                $this->getProvider()
            );

            $this->dispatcher->dispatch(new SaveStockJob($dto));
        }

        return true;
    }

    public function getProvider(): StockProviderEnum
    {
        return StockProviderEnum::tinkoff;
    }
}
