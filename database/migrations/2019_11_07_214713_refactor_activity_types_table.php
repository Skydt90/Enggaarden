<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RefactorActivityTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('activityTypes', 'activity_types');

        Schema::table('activity_types', function (Blueprint $table) {
            $table->renameColumn('activityType', 'activity_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('activity_types', 'activityTypes');
        
        Schema::table('activityTypes', function (Blueprint $table) {
            $table->renameColumn('activity_type', 'activityType');
            $table->dropTimestamps();
        });
    }
}
