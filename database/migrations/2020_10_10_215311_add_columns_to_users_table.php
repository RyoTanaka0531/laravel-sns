<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('prefecture_id')->nullable(true);
            $table->foreign('prefecture_id')->references('id')->on('prefectures');
            $table->bigInteger('genre_id')->nullable(true);
            $table->foreign('genre_id')->references('id')->on('genres');
            $table->integer('age')->nullable(true);
            $table->string('sex')->nullable(true);
            $table->string('address')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
