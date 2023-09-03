<?php

namespace App\Components\Dividends\Handlers;

use App\GetDividends\ObjectValues\DividendValue;
use App\Models\Dividend;
use App\Repositories\Eloquent\DividendEloquentRepository;

class SaveDividendHandler
{
    private DividendEloquentRepository $repository;

    /**
     * @param DividendEloquentRepository $repository
     */
    public function __construct(DividendEloquentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $stockId
     * @param DividendValue $dividendValue
     * @return bool
     */
    public function handle(int $stockId, DividendValue $dividendValue): bool
    {
        // Проверка что текущий див на дату выплаты существует

        $exists = $this->repository->existsByStockIdAndDeclaredDateAndActive(
            $stockId,
            $dividendValue->getDeclaredDate(),
            true
        );

        // Активный дивиденд по акции существует
        if ($exists) {
            return false;
        }

        $dividend = new Dividend();

        $dividend->stock_id = $stockId;
        $dividend->provider = $dividendValue->getProvider()->value;

        // Доход дива
        $dividend->dividend_net_currency = $dividendValue->getDividendNetValue()->getCurrency();
        $dividend->dividend_net_units = $dividendValue->getDividendNetValue()->getUnits();
        $dividend->dividend_net_nano = $dividendValue->getDividendNetValue()->getNano();

        // Закрытие
        $dividend->close_price_currency = $dividendValue->getClosePriceValue()->getCurrency();
        $dividend->close_price_units = $dividendValue->getClosePriceValue()->getUnits();
        $dividend->close_price_nano = $dividendValue->getClosePriceValue()->getNano();

        // Увеличие процент
        $dividend->yield_value_units = $dividendValue->getYieldValue()->getUnits();
        $dividend->yield_value_nano = $dividendValue->getYieldValue()->getNano();

        $dividend->payment_date = $dividendValue->getPaymentDate();
        $dividend->declared_date = $dividendValue->getDeclaredDate();
        $dividend->record_date = $dividendValue->getRecordDate();
        $dividend->last_buy_date = $dividendValue->getLastBuyDate();

        $dividend->dividend_type = $dividendValue->getDividendType();
        $dividend->regularity = $dividendValue->getRegularity();

        $dividend->is_active = true;

        $this->repository->store($dividend);

        return true;
    }
}
