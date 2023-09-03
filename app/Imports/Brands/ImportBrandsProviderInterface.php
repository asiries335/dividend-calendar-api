<?php

namespace App\Imports\Brands;

use App\Enums\BrandProviderEnum;

/**
 * Провайдер импорта брендов
 */
interface ImportBrandsProviderInterface
{
    /**
     * @return bool
     */
    public function asyncHandle(): bool;

    /**
     * @return BrandProviderEnum
     */
    public function getProvider(): BrandProviderEnum;
}
