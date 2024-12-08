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

  
        Schema::create('promocodes', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Название продукта
            $table->binary('img')->nullable();
            $table->string('code')->unique(); // Уникальный код промокода
            $table->text('description')->nullable(); // Полное описание
            $table->text('short_description')->nullable(); // Краткое описание
            $table->boolean('is_active')->default(true); // Активен ли промокод
            $table->decimal('discount_amount'); // Размер скидки
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promocodes');
    }
};
