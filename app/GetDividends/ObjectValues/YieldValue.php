<?php

namespace App\GetDividends\ObjectValues;

class YieldValue
{
    private float $units;
    private float $nano;

    /**
     * @param float $units
     * @param float $nano
     */
    public function __construct(float $units, float $nano)
    {
        $this->units = $units;
        $this->nano = $nano;
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
