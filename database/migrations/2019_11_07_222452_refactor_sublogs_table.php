<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RefactorSublogsTable extends Migration
{
    public function up()
    {
        Schema::rename('subLogs', 'sub_logs');

        Schema::table('sub_logs', function (Blueprint $table) {
            $table->renameColumn('subLogId', 'id');
            $table->renameColumn('editDate', 'edit_date');
            $table->renameColumn('memberId', 'member_id');
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
            $table->renameColumn('id', 'subLogId');
            $table->renameColumn('edit_date', 'editDate');
            $table->renameColumn('member_id', 'memberId');
            $table->dropTimestamps();
        });
    }
}
