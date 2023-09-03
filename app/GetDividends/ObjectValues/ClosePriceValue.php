<?php

namespace App\GetDividends\ObjectValues;

class ClosePriceValue
{
    private string $currency;
    private float $units;
    private float $nano;

    /**
     * @param string $currency
     * @param float $units
     * @param float $nano
     */
    public function __construct(string $currency, float $units, float $nano)
    {
        $this->currency = $currency;
        $this->units = $units;
        $this->nano = $nano;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getUnits(): float
    {
        return $this->units;
    }

    public function getNano(): float
    {
        return $this->nano;
    }
}
