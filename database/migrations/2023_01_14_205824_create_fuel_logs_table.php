<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuelLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuel_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('price');
            $table->string('type',20);
            $table->integer('station_id');
            $table->integer('created_by');
            $table->integer('fuel_id');
            $table->date('price_change_date');
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
        Schema::dropIfExists('fuel_logs');
    }
}
