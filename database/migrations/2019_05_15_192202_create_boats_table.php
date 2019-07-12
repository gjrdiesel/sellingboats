<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('year');
            $table->string('make');
            $table->string('model');
            $table->string('serial_number');
            $table->string('stock_number');
            $table->json('equipment_list');
            $table->integer('list_price');
            $table->timestamps();
        });

        \DB::statement('ALTER TABLE boats ADD FULLTEXT fulltext_index (make,model,serial_number,stock_number)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boats');
    }
}
