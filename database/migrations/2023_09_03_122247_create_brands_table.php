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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->text('description')->nullable();
            $table->text('info')->nullable();
            $table->string('company');
            $table->string('sector')->nullable();
            $table->string('country')->nullable();
            $table->string('website')->nullable();
            $table->string('figi')->nullable();
            $table->string('provider');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
