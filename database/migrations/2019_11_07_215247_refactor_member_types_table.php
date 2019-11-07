<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RefactorMemberTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('memberTypes', 'member_types');

        Schema::table('member_types', function (Blueprint $table) {
            $table->renameColumn('memberType', 'member_type');
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
        Schema::rename('member_types', 'memberTypes');

        Schema::table('memberTypes', function (Blueprint $table) {
            $table->renameColumn('member_type', 'memberType');
            $table->dropTimestamps();
        });
    }
}
