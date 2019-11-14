<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropUserTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropForeign(['user_type']);
        });
        Schema::drop('user_types');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('user_types', function (Blueprint $table) {
            $table->string('user_type', 13)->primary();
            $table->timestamps();
        });
        DB::table('user_types')->insert(['user_type' => 'Administrator']);
        DB::table('user_types')->insert(['user_type' => 'Standard']);

        Schema::table('users', function(Blueprint $table) {
            $table->foreign('user_type')->references('user_type')->on('user_types');
        });
    }
}
