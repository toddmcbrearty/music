<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('biography')->nullable();
            $table->string('profile_type')->default('uri')->comments('this is the way the profile is reached. subdomain, custom url, uri');
            $table->string('profile_pointer')->comments('how to access account. subdomain: account.site.com - url: bandsurl.com - uri: site.com/account');
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
        Schema::drop('bands');
    }
}
