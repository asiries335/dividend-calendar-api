<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Dividend
 *
 * @property int $id
 * @property string $dividend_net_currency Строковый ISO-код валюты
 * @property string $dividend_net_units Целая часть суммы, может быть отрицательным числом
 * @property string $dividend_net_nano Дробная часть суммы, может быть отрицательным числом
 * @property string $close_price_currency Цена закрытия инструмента на момент ex_dividend_date.
 * @property string $close_price_units Целая часть суммы, может быть отрицательным числом
 * @property string $close_price_nano Дробная часть суммы, может быть отрицательным числом
 * @property string|null $yield_value_units Величина доходности. . Целая часть суммы, может быть отрицательным числом
 * @property string|null $yield_value_nano Дробная часть суммы, может быть отрицательным числом
 * @property \Illuminate\Support\Carbon $payment_date Дата фактических выплат в часовом поясе UTC.
 * @property \Illuminate\Support\Carbon $declared_date Дата объявления дивидендов в часовом поясе UTC.
 * @property \Illuminate\Support\Carbon $last_buy_date Последний день (включительно) покупки для получения выплаты в часовом поясе UTC.
 * @property string|null $dividend_type Тип выплаты. Возможные значения: Regular Cash – регулярные выплаты, Cancelled – выплата отменена, Daily Accrual – ежедневное начисление, Return of Capital – возврат капитала, прочие типы выплат.
 * @property \Illuminate\Support\Carbon $record_date Дата фиксации реестра в часовом поясе UTC.
 * @property string|null $regularity Дата фиксации реестра в часовом поясе UTC.
 * @property int $stock_id
 * @property bool $is_active
 * @property string $provider
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Dividend newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dividend newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dividend query()
 * @method static \Illuminate\Database\Eloquent\Builder|Dividend whereClosePriceCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dividend whereClosePriceNano($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dividend whereClosePriceUnits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dividend whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dividend whereDeclaredDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dividend whereDividendNetCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dividend whereDividendNetNano($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dividend whereDividendNetUnits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dividend whereDividendType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dividend whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dividend whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dividend whereLastBuyDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dividend wherePaymentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dividend whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dividend whereRecordDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dividend whereRegularity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dividend whereStockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dividend whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dividend whereYieldValueNano($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dividend whereYieldValueUnits($value)
 * @mixin \Eloquent
 */
class Dividend extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'payment_date' => 'datetime',
        'declared_date' => 'datetime',
        'last_buy_date' => 'datetime',
        'record_date' => 'datetime',
    ];
}
