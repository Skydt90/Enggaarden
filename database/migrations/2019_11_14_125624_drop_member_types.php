<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropMemberTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function(Blueprint $table) {
            $table->dropForeign(['member_type']);
        });
        Schema::drop('member_types');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('member_types', function (Blueprint $table) {
            $table->string('member_type', 8)->primary();
            $table->timestamps();
        });
        DB::table('member_types')->insert(['member_type' => 'Ekstern']);
        DB::table('member_types')->insert(['member_type' => 'Primær']);
        DB::table('member_types')->insert(['member_type' => 'Sekundær']);

        Schema::table('members', function(Blueprint $table) {
            $table->foreign('member_type')->references('member_type')->on('member_types');
        });
    }
}
