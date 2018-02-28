<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->text('fld_User_Id');
            $table->text('fld_User_Name');
            $table->text('fld_Table_Name');
            $table->text('fld_Ip');
            $table->text('fld_Browser');
            $table->text('fld_Changed_Items');
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
        Schema::dropIfExists('tbl_logs');
    }
}
