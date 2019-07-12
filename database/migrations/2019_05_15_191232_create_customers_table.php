<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->longText('address');
            $table->string('email');
            $table->string('phone');
            $table->timestamps();
        });

        Schema::create('customer_sale', function (Blueprint $table) {
            $table->bigInteger('sale_id');
            $table->bigInteger('customer_id');
        });

        \DB::statement('ALTER TABLE customers ADD FULLTEXT fulltext_index (first_name,last_name,address,email,phone)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
        Schema::dropIfExists('customer_sale');
    }
}
