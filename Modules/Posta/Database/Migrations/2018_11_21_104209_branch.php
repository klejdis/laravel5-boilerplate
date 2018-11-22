<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Branch extends Migration
{
    /**
     * Run the migrations.
     * Dega
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table){
            $table->increments('id');
            $table->integer('site_id');
            $table->string('name');
            $table->string('slug')->unique();
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
        Schema::drop('branchesd');
    }
}
