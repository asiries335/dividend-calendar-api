<?php

namespace App\GetDividends\DTO;

use Carbon\CarbonInterface;

class GetDividendsDto
{
    /**
     * @param string $figi
     * @param CarbonInterface $from
     * @param CarbonInterface $to
     */
    public function __construct(readonly string $figi, readonly CarbonInterface $from, readonly CarbonInterface $to)
    {

    }
}
