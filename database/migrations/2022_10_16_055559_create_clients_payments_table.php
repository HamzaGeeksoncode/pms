<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_payments', function (Blueprint $table) {
            $table->id();
            $table->string('attachment')->nullable();
            $table->string('name')->nullable();
            $table->integer('client_id');
            $table->timestamps();
            $table->softDeletes();            
        });
    }    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
 
}
