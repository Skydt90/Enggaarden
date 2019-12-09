<?php

use Carbon\Traits\Timestamp;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RefactorMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("UPDATE members SET mail=null WHERE mail=''");
        DB::statement("UPDATE members SET mail=null WHERE memberId=158");
        Schema::table('members', function (Blueprint $table) {
            $table->renameColumn('memberId', 'id');
            $table->renameColumn('firstName', 'first_name');
            $table->renameColumn('lastName', 'last_name');
            $table->renameColumn('mail', 'email');
            $table->renameColumn('phoneNumber', 'phone_number');
            $table->renameColumn('creationDate', 'created_at');
            $table->renameColumn('memberType', 'member_type');
            $table->renameColumn('isBoard', 'is_board');
        });
        
        Schema::table('members', function (Blueprint $table) {
            $table->string('last_name')->nullable()->change();
            $table->string('email', 100)->unique()->change();
            $table->timestamp('updated_at')->nullable()->after('created_at');
        });

        DB::statement('ALTER TABLE members MODIFY COLUMN created_at TIMESTAMP');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE members MODIFY COLUMN created_at DATE');
        
        Schema::table('members', function (Blueprint $table) {
            $table->string('email', 100)->change();
            $table->dropIndex('email');
            $table->dropIndex('members_email_unique');
            $table->string('last_name')->change();
        });

        Schema::table('members', function (Blueprint $table) {
            $table->renameColumn('id', 'memberId');
            $table->renameColumn('first_name', 'firstName');
            $table->renameColumn('last_name', 'lastName');
            $table->renameColumn('email', 'mail');
            $table->renameColumn('phone_number', 'phoneNumber');
            $table->renameColumn('created_at', 'creationDate');
            $table->renameColumn('member_type', 'memberType');
            $table->renameColumn('is_board', 'isBoard');
            $table->dropColumn('updated_at');
        });
    }
}
