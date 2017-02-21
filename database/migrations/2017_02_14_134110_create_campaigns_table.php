<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->increments('id');
            //$table->string('title');
            $table->string('release_spotify_id')->unique()->nullable();
            $table->string('release_title');
            $table->string('release_artwork');
            $table->string('slug')->unique();
            $table->integer('artist_id')->unsigned()->nullable();
            $table->foreign('artist_id')->references('id')->on('artists');
            $table->string('release_date')->nullable();
            $table->string('preview_track_id')->nullable();
            $table->mediumText('description')->nullable();
            $table->string('background_image')->nullable();
            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users');
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
        Schema::dropIfExists('campaigns');
    }
}
