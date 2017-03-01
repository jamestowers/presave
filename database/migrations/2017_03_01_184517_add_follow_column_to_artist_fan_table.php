<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFollowColumnToArtistFanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('artist_fan', function (Blueprint $table) {
            $table->boolean('follow')->default(false)->after('mailing_list_opt_in');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('artist_fan', function (Blueprint $table) {
            $table->dropColumn('follow');
        });
    }
}
