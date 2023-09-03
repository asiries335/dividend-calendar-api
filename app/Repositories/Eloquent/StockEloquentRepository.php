<?php

namespace App\Repositories\Eloquent;

use App\Models\Stock;
use Illuminate\Support\LazyCollection;

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
     * @return LazyCollection
     */
    public function getAllCursor(): LazyCollection
    {
        return Stock::query()->cursor();
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
