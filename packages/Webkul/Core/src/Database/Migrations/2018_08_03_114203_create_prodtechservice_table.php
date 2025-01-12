<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdTechServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('prodtechservices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->string('brand');
            $table->string('model');
            $table->string('arrival');
            $table->string('return');
            $table->string('status');
            $table->integer('techservice_id');
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
        Schema::dropIfExists('prodtechservices');
    }
}
