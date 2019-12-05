<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ReassignIdToActivityTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contributions', function (Blueprint $table){
            $table->dropForeign(['activity_type']);
            $table->dropColumn('activity_type');
            //$table->dropIndex('activityType');
        });
        Schema::table('activity_types', function (Blueprint $table) {
            $table->dropPrimary('activity_type');
        });
        Schema::table('activity_types', function (Blueprint $table) {
            $table->bigIncrements('id')->first();
            $table->string('activity_type')->change();
        });
        Schema::table('contributions', function (Blueprint $table){
            $table->unsignedBigInteger('activity_type_id')->after('id');
        });
        DB::table('activity_types')->insert([
            'activity_type' => 'Gammel data'
        ]);
        DB::table('contributions')->update([
            'activity_type_id' => 19
        ]);
        Schema::table('contributions', function (Blueprint $table){
            $table->foreign('activity_type_id')->references('id')->on('activity_types')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contributions', function (Blueprint $table) {
            $table->dropForeign(['activity_type_id']);
            $table->dropColumn('activity_type_id');
         });
        Schema::table('activity_types', function (Blueprint $table) {
            $table->dropColumn('id');
        });
        DB::table('activity_types')->where('activity_type', '=', 'Gammel data')->delete();
        Schema::table('activity_types', function (Blueprint $table) {
            $table->primary('activity_type');
        });
        Schema::table('contributions', function (Blueprint $table) {
            $table->string('activity_type');
        });
        DB::table('contributions')->update([
            'activity_type' => 'Bowling'
        ]);
        Schema::table('contributions', function (Blueprint $table) {
            $table->foreign('activity_type')->references('activity_type')->on('activity_types');
        });
    }
}
