<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RefactorSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->renameColumn('memberId', 'id');
            $table->renameColumn('payDate', 'pay_date');
            $table->timestamps();
        });
        
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropForeign(['id']);
            $table->renameColumn('id', 'member_id');
            $table->dropPrimary('member_id');
        });

        // new primary has to be added in seperate function or it fails for some reason
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id')->first();
            $table->unsignedBigInteger('member_id')->nullable()->change();
        });     
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->unsignedBigInteger('member_id')->nullable(false)->change();    
        });

        Schema::table('subscriptions', function(Blueprint $table) {
            $table->dropColumn('id');
            $table->primary('member_id');
            $table->renameColumn('member_id', 'id');
        });

        // same here. Further mods on primary key has to be done seperately
        Schema::table('subscriptions', function(Blueprint $table) {
            $table->smallInteger('id')->change();
            $table->foreign('id')->references('id')->on('members');
        });

        Schema::table('subscriptions', function (Blueprint $table) {
            $table->renameColumn('id', 'memberId');
            $table->renameColumn('pay_date', 'payDate');
            $table->dropTimestamps();
        });
    }
}
