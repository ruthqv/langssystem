<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLangfieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lang_fields', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('id_lang')->unsigned();
            $table->foreign('id_lang')->references('id_lang')->on('langs')->onDelete('cascade')->onUpdate('cascade');
            $table->morphs('langstable',190); //la clave de todo
            $table->string('name',100)->nullable();       
            $table->text('description')->nullable();     
            $table->string('uri',50)->nullable();
            $table->text('features')->nullable();    
            $table->longtext('html_block')->nullable();    
            $table->text('otherfields')->nullable(); 
            $table->string('delivery_time')->nullable();                             
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
        Schema::drop('lang_fields');
    }
}