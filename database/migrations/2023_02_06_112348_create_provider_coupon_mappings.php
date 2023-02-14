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
        Schema::create('provider_coupon_mappings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('provider_id')->nullable();
            $table->string('code')->nullable();
            $table->double('discount')->nullable();
            $table->string('discount_type')->nullable();
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
        Schema::dropIfExists('provider_coupon_mappings');
    }
};
