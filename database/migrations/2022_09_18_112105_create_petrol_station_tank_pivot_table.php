<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetrolStationtankPivotTable extends Migration
{
    public function up()
    {
        Schema::create('petrol_station_tank', function (Blueprint $table) {
            $table->integer('petrol_station_id');
            $table->integer('tank_id');
        });
    }
}
