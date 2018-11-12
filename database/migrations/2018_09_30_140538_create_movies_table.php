<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('movie_id');
            $table->string('tagline');
            $table->string('title');
            $table->string('original_title');
            $table->string('homepage');
            $table->string('original_language');
            $table->text('overview');
            $table->integer('runtime');
            $table->string('status');
            $table->date('release_date');
            $table->float('popularity',9, 6);
            $table->json('genres');
            $table->json('keywords');
            $table->json('production_companies');
            $table->json('production_countries');
            $table->json('spoken_languages');
            $table->bigInteger('budget');
            $table->bigInteger('revenue');
            $table->float('vote_average',2, 1);
            $table->bigInteger('vote_count');
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
        Schema::dropIfExists('movies');
    }
}
