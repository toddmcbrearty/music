<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BandMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('band_members', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('band_id')->nullable()->unsigned();
            $table->integer('user_id')->nullable()->unsigned();
            $table->string('name')->nullable();
            $table->tinyInteger('status')->default(0)->comments('0=pending; 1=linked; 2=denied_by_member; 3=denied_by_band');
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
        Schema::drop('band_members');
    }
}
