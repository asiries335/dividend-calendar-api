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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();

            $table->string('figi');
            $table->string('ticker');
            $table->string('class_code');
            $table->string('isin');
            $table->string('currency');
            $table->string('name');
            $table->string('exchange');
            $table->string('sector');
            $table->string('country');
            $table->timestamp('ipo_date');
            $table->string('provider');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
