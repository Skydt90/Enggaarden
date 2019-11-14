<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AssignRelationshipsToMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->bigInteger('id')->change()->autoIncrement();
        });

        Schema::table('subscriptions', function (Blueprint $table) {
            $table->foreign('member_id')->references('id')->on('members');
        });

        Schema::table('addresses', function(Blueprint $table) {
            $table->foreign('member_id')->references('id')->on('members');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addresses', function(Blueprint $table) {
            $table->dropForeign(['member_id']);
        });

        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropForeign(['member_id']);
        });

        Schema::table('members', function (Blueprint $table) {
            $table->smallInteger('id')->change();
        });
    }
}
