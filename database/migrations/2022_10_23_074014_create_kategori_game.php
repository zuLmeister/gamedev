<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_game', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id');
            $table->foreignId('kategori_id');
            $table->timestamps();

            $table->foreign('game_id')->references('id')->on('game');
            $table->foreign('kategori_id')->references('id')->on('kategori');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategori_game');
    }
};
