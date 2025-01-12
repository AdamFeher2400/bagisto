<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLocaleIdInCarTranslations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('car_translations', function (Blueprint $table) {
            $table->integer('locale_id')->nullable()->unsigned();
        });

        Schema::table('car_translations', function (Blueprint $table) {
            $table->foreign('locale_id')->references('id')->on('locales')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
