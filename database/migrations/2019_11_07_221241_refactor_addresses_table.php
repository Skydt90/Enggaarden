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
        //Not sure if foreign key alterations are needed.
        //when renaming the column. Seems to work atm like this.
        Schema::table('addresses', function (Blueprint $table) {
            $table->renameColumn('memberId', 'member_id');
            $table->renameColumn('streetName', 'street_name');
            $table->renameColumn('zipCode', 'zip_code');
            $table->timestamps();
            //$table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->renameColumn('member_id', 'memberId');
            $table->renameColumn('street_name', 'streetName');
            $table->renameColumn('zip_code', 'zipCode');
            $table->dropTimestamps();
            //$table->foreign('memberId')->references('id')->on('members')->onDelete('cascade');
        });
    }
}
