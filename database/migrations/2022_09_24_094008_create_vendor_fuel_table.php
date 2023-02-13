<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorFuelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_fuel', function (Blueprint $table) {
            $table->id();

            $table->decimal("petrol_quantity")->nullable();
            $table->decimal("diesel_quantity")->nullable();
            $table->string("attachment")->nullable();
            $table->string("serial_no");
            $table->integer("vendor_id");
            $table->integer("user_id");
            $table->integer("station_id");
            $table->integer("petrol_tank_id")->nullable();
            $table->integer("diesel_tank_id")->nullable();
            $table->decimal("price");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor_fuel');
    }
}
