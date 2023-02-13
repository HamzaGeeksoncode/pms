<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('station_id');
            $table->string('name');
            $table->string('company_name');
            $table->string('pay_type',55);
            $table->string('contact_number_1');
            $table->string('contact_number_2')->nullable();
            $table->string('petrol_limit',55)->nullable();
            $table->string('diesel_limit',55)->nullable();
            $table->decimal('petrol_quan')->nullable();
            $table->decimal('diesel_quan')->nullable();
            $table->decimal('petrol_discount')->nullable();
            $table->decimal('diesel_discount')->nullable();
            $table->decimal('remaining_petrol_quan')->nullable();
            $table->decimal('remaining_diesel_quan')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
