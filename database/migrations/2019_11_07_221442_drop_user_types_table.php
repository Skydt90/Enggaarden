<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropUserTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* Schema::table('users', function(Blueprint $table) {
            $table->dropForeign(['userType']);
        }); */
        
        Schema::drop('userTypes');

    }

    public function down()
    {

        Schema::create('userTypes', function (Blueprint $table) {
            $table->string('userType', 13)->primary();
        });

        DB::table('userTypes')->insert(['userType' => 'Administrator']);
        DB::table('userTypes')->insert(['userType' => 'Standard']);

        /* Schema::table('users', function(Blueprint $table) {
            $table->foreign('userType')->references('userType')->on('userTypes');
        }); */
    }
}
