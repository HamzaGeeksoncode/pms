<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetrolStationUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('petrol_station_user', function (Blueprint $table) {
            $table->integer('petrol_station_id');
            $table->integer('user_id');
        });
    }
}
