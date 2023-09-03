<?php

namespace App\Components\Brands\Handlers\DTO;

use App\Enums\BrandProviderEnum;

class SaveBrandDto
{
    /**
     * @param string $name
     * @param string|null $description
     * @param string|null $info
     * @param string $company
     * @param string $sector
     * @param string $country
     * @param string|null $website
     * @param string|null $figi
     * @param BrandProviderEnum $providerEnum
     */
    public function __construct(
        readonly string            $name,
        readonly BrandProviderEnum $providerEnum,
        readonly string            $company,
        readonly string            $sector,
        readonly string            $country,
        readonly ?string           $website = null,
        readonly ?string           $figi = null,
        readonly ?string           $description = null,
        readonly ?string           $info = null
    )
    {

    }
}
