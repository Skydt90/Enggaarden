<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RefactorAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //renames
        Schema::table('addresses', function (Blueprint $table) {
            $table->renameColumn('memberId', 'member_id');
            $table->renameColumn('streetName', 'street_name');
            $table->renameColumn('zipCode', 'zip_code');
            $table->timestamps();
        });
        
        //drop foreign and primary
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropForeign(['member_id']);
            $table->dropPrimary('member_id');
        });
        
        //new primary and change old to bigint
        Schema::table('addresses', function (Blueprint $table) {
            $table->bigIncrements('id')->first();
            $table->bigInteger('member_id')->unique()->unsigned()->change();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addresses', function(Blueprint $table) {
            $table->dropColumn('id');
            $table->primary('member_id');
            $table->dropIndex('member_id');
            $table->dropIndex('addresses_member_id_unique');
        });

        // same here. Further mods on primary key has to be done seperately
        Schema::table('addresses', function(Blueprint $table) {
            $table->smallInteger('member_id')->change();
            $table->foreign('member_id')->references('id')->on('members');
        });

        Schema::table('addresses', function (Blueprint $table) {
            $table->renameColumn('member_id', 'memberId');
            $table->renameColumn('street_name', 'streetName');
            $table->renameColumn('zip_code', 'zipCode');
            $table->dropTimestamps();
        });
    }
}
