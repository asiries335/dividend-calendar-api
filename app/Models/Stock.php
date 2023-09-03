<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Stock
 *
 * @property int $id
 * @property string $figi
 * @property string $ticker
 * @property string $class_code
 * @property string $isin
 * @property string $currency
 * @property string $name
 * @property string $exchange
 * @property string $sector
 * @property string $country
 * @property \Illuminate\Support\Carbon $ipo_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Stock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock query()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereClassCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereExchange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereFigi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereIpoDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereIsin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereSector($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereTicker($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereUpdatedAt($value)
 * @property string $provider
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereProvider($value)
 * @mixin \Eloquent
 */
class Stock extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'ipo_date' => 'datetime',
    ];
}
