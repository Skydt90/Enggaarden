<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RefactorContributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contributions', function (Blueprint $table) {
            $table->renameColumn('contributionId', 'id');
            $table->renameColumn('activityType', 'activity_type');
            $table->renameColumn('paymentDate', 'pay_date');
            $table->timestamps();
        });

        Schema::table('contributions', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement()->change();
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
            $table->renameColumn('id', 'contributionId');
            $table->renameColumn('activity_type', 'activityType');
            $table->renameColumn('pay_date', 'paymentDate');
            $table->dropTimestamps();
        });
        
        Schema::table('contributions', function (Blueprint $table) {
            $table->integer('contributionId')->change();
        });
    }
}
