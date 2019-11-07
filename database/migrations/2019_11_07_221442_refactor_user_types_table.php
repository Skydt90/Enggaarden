<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RefactorUserTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('userTypes', 'user_types');

        Schema::table('user_types', function (Blueprint $table) {
            $table->renameColumn('userType', 'user_type');
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
        Schema::rename('user_types', 'userTypes');

        Schema::table('userTypes', function (Blueprint $table) {
            $table->renameColumn('user_type', 'userType');
            $table->dropTimestamps();
        });
    }
}
