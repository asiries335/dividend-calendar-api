<?php

namespace App\Repositories\Eloquent;


use App\Models\Dividend;
use Carbon\CarbonInterface;

class DividendEloquentRepository
{
    /**
     * @param Dividend $dividend
     * @return bool
     */
    public function store(Dividend $dividend): bool
    {
        return $dividend->save();
    }

    /**
     * @param int $stockId
     * @param CarbonInterface $declaredDate
     * @param bool $isActive
     * @return bool
     */
    public function existsByStockIdAndDeclaredDateAndActive(int $stockId, CarbonInterface $declaredDate, bool $isActive): bool
    {
        return Dividend::query()
            ->where('stock_id', '=', $stockId)
            ->whereDate('declared_date', $declaredDate)
            ->where('is_active', $isActive)
            ->exists();
    }

}
