<?php

namespace App\GetDividends\Handlers;

use App\Enums\DividendProviderEnum;
use App\GetDividends\DTO\GetDividendsDto;
use App\GetDividends\GetDividendsHandlerInterface;
use App\GetDividends\ObjectValues\ClosePriceValue;
use App\GetDividends\ObjectValues\DividendNetValue;
use App\GetDividends\ObjectValues\DividendValue;
use App\GetDividends\ObjectValues\YieldValue;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Psr\Log\LoggerInterface;

class TinkoffRestApiGetDividendsHandler implements GetDividendsHandlerInterface
{
    private Http $http;
    private Config $config;
    private LoggerInterface $logger;

    /**
     * @param Http $http
     * @param Config $config
     * @param LoggerInterface $logger
     */
    public function __construct(Http $http, Config $config, LoggerInterface $logger)
    {
        $this->http = $http;
        $this->config = $config;
        $this->logger = $logger;
    }

    /**
     * @param GetDividendsDto $dto
     * @return array|DividendValue[]|false
     */
    public function handle(GetDividendsDto $dto): array
    {
        $token = $this->config::get('services.tinkoff.token');

        $this->logger->info('GetDividendsStart', [
            'figi' => $dto->figi,
            'from' => $dto->from->toIso8601String(),
            'to' => $dto->to->toIso8601String()
        ]);


        $response = $this->http::withToken(
            $token
        )->post('https://invest-public-api.tinkoff.ru/rest/tinkoff.public.invest.api.contract.v1.InstrumentsService/GetDividends', [
            'figi' => $dto->figi,
            'from' => $dto->from->toIso8601String(),
            'to' => $dto->to->toIso8601String()
        ]);

        $this->logger->info('GetDividendsEnds', [
            'figi' => $dto->figi,
            'from' => $dto->from->toIso8601String(),
            'to' => $dto->to->toIso8601String(),
            'response' => $response
        ]);

        $dividends = $response->json()['dividends'];

        $data = [];

        if (!$dividends) {
            return $data;
        }

        foreach ($dividends as $dividend) {

            $dividendNet = new DividendNetValue(
                $dividend['dividendNet']['currency'],
                $dividend['dividendNet']['units'],
                $dividend['dividendNet']['nano']
            );

            $closePrice = new ClosePriceValue(
                $dividend['closePrice']['currency'],
                $dividend['closePrice']['units'],
                $dividend['closePrice']['nano']
            );

            $yield = new YieldValue(
                $dividend['yieldValue']['units'],
                $dividend['yieldValue']['nano']
            );

            $dividendValue = new DividendValue(
                $this->getProvider(),
                $dividendNet,
                $closePrice,
                $yield,
                Carbon::parse($dividend['paymentDate']),
                Carbon::parse($dividend['declaredDate']),
                Carbon::parse($dividend['lastBuyDate']),
                Carbon::parse($dividend['recordDate']),
                $dividend['regularity'],
                $dividend['dividendType'],
            );

            $data[] = $dividendValue;
        }

        return $data;
    }

    /**
     * @return DividendProviderEnum
     */
    public function getProvider(): DividendProviderEnum
    {
        return DividendProviderEnum::tinkoff;
    }
}
