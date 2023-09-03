<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dividends', function (Blueprint $table) {
            $table->id();

            $table->string('dividend_net_currency')->comment('Строковый ISO-код валюты');
            $table->decimal('dividend_net_units', 12)->comment('Целая часть суммы, может быть отрицательным числом');
            $table->decimal('dividend_net_nano', 12)->comment('Дробная часть суммы, может быть отрицательным числом');

            $table->string('close_price_currency')->comment('Цена закрытия инструмента на момент ex_dividend_date.');
            $table->decimal('close_price_units', 12)->comment('Целая часть суммы, может быть отрицательным числом');
            $table->decimal('close_price_nano', 12)->comment('Дробная часть суммы, может быть отрицательным числом');

            $table->decimal('yield_value_units', 12)->nullable()->comment('Величина доходности. . Целая часть суммы, может быть отрицательным числом');
            $table->decimal('yield_value_nano', 12)->nullable()->comment('Дробная часть суммы, может быть отрицательным числом');


            $table->timestamp('payment_date')->comment('Дата фактических выплат в часовом поясе UTC.');
            $table->timestamp('declared_date')->comment('Дата объявления дивидендов в часовом поясе UTC.');
            $table->timestamp('last_buy_date')->comment('Последний день (включительно) покупки для получения выплаты в часовом поясе UTC.');
            $table->string('dividend_type')->nullable()->comment('Тип выплаты. Возможные значения: Regular Cash – регулярные выплаты, Cancelled – выплата отменена, Daily Accrual – ежедневное начисление, Return of Capital – возврат капитала, прочие типы выплат.');
            $table->timestamp('record_date')->comment('Дата фиксации реестра в часовом поясе UTC.');
            $table->string('regularity')->nullable()->comment('Дата фиксации реестра в часовом поясе UTC.');

            $table->unsignedBigInteger('stock_id');
            $table->foreign('stock_id')
                ->on('stocks')->references('id');

            $table->boolean('is_active')->default(false);

            $table->string('provider')->comment('');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dividends');
    }
};
