<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->decimal('subtotal', 14, 2);
            $table->decimal('tax', 14, 2);
            $table->decimal('delivery_price', 14, 2);
            $table->decimal('sum_total', 14, 2);
            $table->string('name');
            $table->string('email');
            $table->string('recipient_country');
            $table->string('recipient_state');
            $table->string('recipient_city');
            $table->string('recipient_address');
            $table->string('currency');
            $table->enum('payment_method', ['cash_delivery', 'card_online']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
