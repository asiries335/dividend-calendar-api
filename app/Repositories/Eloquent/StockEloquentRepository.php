<?php

namespace App\Repositories\Eloquent;

use App\Models\Stock;

class StockEloquentRepository
{
    /**
     * @param Stock $stock
     * @return bool
     */
    public function store(Stock $stock): bool
    {
        return $stock->save();
    }

    /**
     * @param string $figi
     * @return Stock|null
     */
    public function findByFigi(string $figi): ?Stock
    {
        return Stock::query()->where('figi', $figi)->first();
    }
}
