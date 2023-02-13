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
            $table->date("date");
            $table->decimal("petrol_discount")->nullable();
            $table->decimal("petrol_quan")->nullable();
            $table->decimal("petrol_total")->nullable();
            $table->decimal("petrol_after_discount")->nullable();
            $table->decimal("petrol_final_price")->nullable();
            $table->string("petrol_limit",55)->nullable();
            $table->decimal("petrol_current_price")->nullable();
            $table->decimal("diesel_discount")->nullable();
            $table->decimal("diesel_quan")->nullable();
            $table->decimal("diesel_total")->nullable();
            $table->decimal("diesel_final_price")->nullable();
            $table->decimal("diesel_after_discount")->nullable();
            $table->string("diesel_limit",55)->nullable();
            $table->decimal("diesel_current_price")->nullable();            
            $table->integer("client_id");
            $table->integer("created_by");                    
            $table->integer("station_id");                    
            $table->integer("shift_id");                    
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
        Schema::dropIfExists('orders');
    }
}
