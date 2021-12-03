<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblChamCong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tbl_cham_cong', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_nhanvien')->unsigned();
            $table->dateTime('gio_den')->nullable();
            $table->dateTime('gio_ve')->nullable();
            $table->tinyInteger('trang_thai');
            $table->float('so_cong');
            $table->float('bi_phat');
            //
        });

        Schema::table('tbl_cham_cong', function($table) {
            $table->foreign('id_nhanvien')->references('id_nhanvien')->on('tbl_nhanvien');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
