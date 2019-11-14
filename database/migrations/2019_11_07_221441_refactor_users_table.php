<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RefactorUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('userPassword', 'password');
            $table->renameColumn('userType', 'user_type');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['user_type']);
            $table->dropPrimary('username');
        });
        
        // new primary has to be added in seperate function or it fails for some reason
        Schema::table('users', function (Blueprint $table) {
            $table->bigIncrements('id')->first();
            //$table->string('username')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('id');
            $table->primary('username');
        });

        // same here. Further mods on primary key has to be done seperately
        Schema::table('users', function(Blueprint $table) {
            //$table->dropUnique('username')->change(); FIX!!!!!!
            $table->foreign('user_type')->references('userType')->on('userTypes');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('password', 'userPassword');
            $table->renameColumn('user_type', 'userType');
            $table->dropColumn('email_verified_at');
            $table->dropRememberToken();
            $table->dropTimestamps();
        });
    }
}
