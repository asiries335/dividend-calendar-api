<?php

namespace App\Components\Stocks\Handlers\DTO;

use App\Enums\StockProviderEnum;
use Carbon\CarbonInterface;

class SaveStockDto
{
    /**
     * @param string $figi
     * @param string $ticker
     * @param string $classCode
     * @param string $isin
     * @param string $currency
     * @param string $name
     * @param string $exchange
     * @param string $sector
     * @param string $country
     * @param CarbonInterface $ipoDate
     */
    public function __construct(
        readonly string            $figi,
        readonly string            $ticker,
        readonly string            $classCode,
        readonly string            $isin,
        readonly string            $currency,
        readonly string            $name,
        readonly string            $exchange,
        readonly string            $sector,
        readonly string            $country,
        readonly CarbonInterface   $ipoDate,
        readonly StockProviderEnum $providerEnum
    )
    {

    }
}
