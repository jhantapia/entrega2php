<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->integer('game_id')->unsigned()->nullable();
            $table->foreign('game_id')->references('id')->on('game')->onDelete('set null');

            $table->integer('media_type_id')->unsigned()->nullable();
            $table->foreign('media_type_id')->references('id')->on('media_types')->onDelete('set null');

            $table->increments('id');
            $table->text('storage')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('media');
    }
}
