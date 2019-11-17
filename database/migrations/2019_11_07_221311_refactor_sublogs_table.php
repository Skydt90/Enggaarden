<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RefactorSublogsTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('subLogs')) {
            Schema::drop('subLogs');
        }
        
        /* Schema::rename('subLogs', 'sub_logs');

        Schema::table('sub_logs', function (Blueprint $table) {
            $table->renameColumn('subLogId', 'id');
            $table->renameColumn('editDate', 'edit_date');
            $table->renameColumn('memberId', 'member_id');
            $table->timestamps();
        });

        Schema::table('sub_logs', function(Blueprint $table) {
            $table->dropForeign(['member_id']);
            $table->dropForeign(['username']);
            $table->dropIndex('memberId');
            $table->dropIndex('username');
        }); */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /* Schema::table('sub_logs', function(Blueprint $table) {
            $table->foreign('member_id')->references('id')->on('members');
            $table->renameIndex('sub_logs_member_id_foreign', 'memberId');
            $table->foreign('username')->references('username')->on('users');
            $table->renameIndex('sub_logs_username_foreign', 'username');
        });
        
        Schema::rename('sub_logs', 'subLogs');

        Schema::table('subLogs', function (Blueprint $table) {
            $table->renameColumn('id', 'subLogId');
            $table->renameColumn('edit_date', 'editDate');
            $table->renameColumn('member_id', 'memberId');
            $table->dropTimestamps();
        }); */
    }
}
