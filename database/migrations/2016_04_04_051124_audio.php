<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Audio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audio_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('filesize');
            $table->string('filepath');
            $table->string('fileformat');
            $table->string('seconds');
            $table->string('filename');
            $table->string('fileextension');
            $table->integer('band_id')->unsigned();
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
        Schema::drop('audio_files');
    }
}
