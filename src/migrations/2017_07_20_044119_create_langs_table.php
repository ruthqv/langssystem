<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLangsTable extends Migration
{
    public function up()
    {
        Schema::create('langs', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('id_lang')->index('langs_id_lang')->unsigned();
            $table->string('name',100);   
            $table->string('iso_code',25);                         
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
        Schema::drop('langs');
    }
}