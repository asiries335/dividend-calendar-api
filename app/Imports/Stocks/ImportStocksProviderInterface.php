<?php

namespace App\Imports\Stocks;

use App\Enums\StockProviderEnum;

/**
 * Провайдер импорта акций
 */
interface ImportStocksProviderInterface
{
    /**
     * Асинхронный импорт акций
     *
     * @return bool
     */
    public function asyncHandle(): bool;

    /**
     * @return StockProviderEnum
     */
    public function getProvider(): StockProviderEnum;
}
