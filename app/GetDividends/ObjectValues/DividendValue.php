<?php

namespace App\GetDividends\ObjectValues;

use App\Enums\DividendProviderEnum;
use Carbon\CarbonInterface;

class DividendValue
{
    private DividendNetValue $dividendNetValue;
    private ClosePriceValue $closePriceValue;
    private YieldValue $yieldValue;
    private CarbonInterface $paymentDate;
    private CarbonInterface $declaredDate;
    private CarbonInterface $lastBuyDate;
    private CarbonInterface $recordDate;
    private string $regularity;
    private ?string $dividendType;
    private DividendProviderEnum $provider;

    /**
     * @param DividendNetValue $dividendNetValue Величина дивиденда на 1 ценную бумагу (включая валюту).
     * @param ClosePriceValue $closePriceValue Цена закрытия инструмента на момент ex_dividend_date.
     * @param YieldValue $yieldValue Величина доходности.
     * @param CarbonInterface $paymentDate Дата фактических выплат в часовом поясе UTC.
     * @param CarbonInterface $declaredDate Дата объявления дивидендов в часовом поясе UTC.
     * @param CarbonInterface $lastBuyDate Последний день (включительно) покупки для получения выплаты в часовом поясе UTC.
     * @param CarbonInterface $recordDate Дата фиксации реестра в часовом поясе UTC.
     * @param string $regularity Регулярность выплаты. Возможные значения: Annual – ежегодная, Semi-Anl – каждые полгода, прочие типы выплат.
     * @param string|null $dividendType Тип выплаты. Возможные значения: Regular Cash – регулярные выплаты, Cancelled – выплата отменена, Daily Accrual – ежедневное начисление, Return of Capital – возврат капитала, прочие типы выплат.
     */
    public function __construct(
        DividendProviderEnum $provider,
        DividendNetValue     $dividendNetValue,
        ClosePriceValue      $closePriceValue,
        YieldValue           $yieldValue,
        CarbonInterface      $paymentDate,
        CarbonInterface      $declaredDate,
        CarbonInterface      $lastBuyDate,
        CarbonInterface      $recordDate,
        string               $regularity,
        ?string              $dividendType = null
    )
    {
        $this->dividendNetValue = $dividendNetValue;
        $this->closePriceValue = $closePriceValue;
        $this->yieldValue = $yieldValue;
        $this->paymentDate = $paymentDate;
        $this->declaredDate = $declaredDate;
        $this->lastBuyDate = $lastBuyDate;
        $this->recordDate = $recordDate;
        $this->regularity = $regularity;
        $this->dividendType = $dividendType;
        $this->provider = $provider;
    }

    public function getDividendNetValue(): DividendNetValue
    {
        return $this->dividendNetValue;
    }

    public function getClosePriceValue(): ClosePriceValue
    {
        return $this->closePriceValue;
    }

    public function getYieldValue(): YieldValue
    {
        return $this->yieldValue;
    }

    public function getPaymentDate(): CarbonInterface
    {
        return $this->paymentDate;
    }

    public function getDeclaredDate(): CarbonInterface
    {
        return $this->declaredDate;
    }

    public function getLastBuyDate(): CarbonInterface
    {
        return $this->lastBuyDate;
    }

    public function getRecordDate(): CarbonInterface
    {
        return $this->recordDate;
    }

    public function getRegularity(): string
    {
        return $this->regularity;
    }

    public function getDividendType(): ?string
    {
        return $this->dividendType;
    }

    public function getProvider(): DividendProviderEnum
    {
        return $this->provider;
    }
}


