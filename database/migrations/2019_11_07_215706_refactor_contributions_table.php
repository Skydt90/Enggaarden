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
            $table->renameColumn('paymentDate', 'payment_date');
            $table->timestamps();
            //maybe foreign key mods,
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
            $table->renameColumn('payment_date', 'paymentDate');
            $table->dropTimestamps();
            //maybe foreign??
        });
    }
}
