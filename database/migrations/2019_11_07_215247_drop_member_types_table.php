<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropMemberTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function(Blueprint $table) {
            $table->dropForeign(['memberType']);
            $table->dropIndex('memberType');
        });

        Schema::drop('memberTypes');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::create('memberTypes', function (Blueprint $table) {
            $table->string('memberType', 8)->primary();
        });
        
        DB::table('memberTypes')->insert(['memberType' => 'Ekstern']);
        DB::table('memberTypes')->insert(['memberType' => 'Primær']);
        DB::table('memberTypes')->insert(['memberType' => 'Sekundær']);

        Schema::table('members', function(Blueprint $table) {
            $table->foreign('memberType')->references('memberType')->on('memberTypes');
            $table->renameIndex('members_membertype_foreign', 'memberType');
        });
        
    }
}
