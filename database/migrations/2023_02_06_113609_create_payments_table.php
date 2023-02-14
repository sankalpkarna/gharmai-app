<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('provider_id');
            $table->unsignedBigInteger('booking_id');



            $table->double('discount')->nullable()->default('0');
            $table->longText('tax')->nullable();
            $table->double('total_amount')->nullable()->default('0');
            $table->string('payment_type', 100);

            $table->dateTime('paid_date')->nullable()->default(null);
            $table->text('payment_method')->nullable();
            $table->string('payment_status', 20)->nullable()->default(null)->comment('pending, paid , failed');


            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');


            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
