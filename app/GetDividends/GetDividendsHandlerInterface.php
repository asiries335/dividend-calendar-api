<?php

namespace App\GetDividends;

use App\Enums\DividendProviderEnum;
use App\GetDividends\DTO\GetDividendsDto;
use App\GetDividends\ObjectValues\DividendValue;

/**
 * Обработчик получений дивидендов
 */
interface GetDividendsHandlerInterface
{
    /**
     * @param GetDividendsDto $dto
     * @return DividendValue[]
     */
    public function handle(GetDividendsDto $dto): array;

    /**
     * @return DividendProviderEnum
     */
    public function getProvider(): DividendProviderEnum;
}
