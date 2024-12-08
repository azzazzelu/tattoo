<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('fullName_data'); // ФИО
            $table->string('phoneNumber_data')->nullable(); // Телефон
            $table->string('emailAddress_data')->nullable(); // Эл. почта
            $table->string('city_data')->nullable(); // Город
            $table->string('streetHouse_data')->nullable(); // Улица
            $table->string('apartmentOffice_data')->nullable(); // Квартира/Офис
            $table->unsignedSmallInteger('entrance_data')->nullable(); // Подъезд
            $table->unsignedTinyInteger('floor_data')->nullable(); // Этаж
            $table->string('intercom_data')->nullable(); // Код домофона
            $table->integer('allQuantity')->default(0); // Всего единиц товара
            $table->decimal('allTotal', 8, 2)->default(0.00); // Итоговая сумма
            $table->enum('payment_method', ['cash', 'card', 'online'])->default('cash'); // Способ оплаты
            $table->enum('delivery_method', ['post_russia', 'courier'])->default('courier'); // Тип доставки
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
