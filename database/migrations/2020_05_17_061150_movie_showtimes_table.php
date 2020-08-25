<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MovieShowtimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_showtimes', function (Blueprint $table) {
            $table->id();
            $table->integer('cinema_id')->nullable();
            $table->date('date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('time')->nullable();
            $table->string('url')->nullable();
            $table->integer('is_active')->nullable();
            $table->integer('2d')->default(0);
            $table->integer('3d')->default(0);
            $table->bigInteger('movie_id')->nullable();
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
        Schema::dropIfExists('movie_showtimes');
    }
}
