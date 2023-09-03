<?php

namespace App\Imports\Brands\Providers;

use App\Components\Brands\Handlers\DTO\SaveBrandDto;
use App\Enums\BrandProviderEnum;
use App\Imports\Brands\ImportBrandsProviderInterface;
use App\Jobs\SaveBrandJob;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class TinkoffRestApiImportBrandsProvider implements ImportBrandsProviderInterface
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
        )->post('https://invest-public-api.tinkoff.ru/rest/tinkoff.public.invest.api.contract.v1.InstrumentsService/GetBrands', [
            'req' => 1
        ]);

        $data = $response->json()['brands'];


        foreach ($data as $brand) {


            $dto = new SaveBrandDto(
                $brand['name'],
                BrandProviderEnum::tinkoff,
                $brand['company'],
                $brand['sector'] ?? 'other',
                $brand['countryOfRisk'] ?? 'other',
                null,
                null,
                $brand['description'],
                $brand['info'],
            );

            $this->dispatcher->dispatch(new SaveBrandJob($dto));
        }

        return true;
    }

    public function getProvider(): BrandProviderEnum
    {
        return BrandProviderEnum::tinkoff;
    }
}
