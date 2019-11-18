<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        });
        Schema::table('contributions', function (Blueprint $table){
            $table->unsignedBigInteger('activity_type_id')->after('id');
        });
        DB::table('contributions')->update([
            'activity_type_id' => 1
        ]);
        Schema::table('contributions', function (Blueprint $table){
            $table->foreign('activity_type_id')->references('id')->on('activity_types');
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
