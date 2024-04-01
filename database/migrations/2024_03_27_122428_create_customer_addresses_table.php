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
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('address1',255);
            $table->string('address2',255);
            $table->string('city',255);
            $table->string('district',45)->nullable();
            $table->string('zipcode',45);
            $table->foreignId('customer_id')->references('id')->on('customers');
            $table->foreignId('country_code')->references('id')->on('countries');
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
        Schema::dropIfExists('customer_addresses');
    }
};