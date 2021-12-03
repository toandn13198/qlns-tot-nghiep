<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblLuong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tbl_luong', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_nhanvien')->unsigned();
            $table->date('ngay_tinh');
            $table->float('tong_so_cong');
            $table->float('tong_tien_luong');
            $table->float('khau_tru')->nullable();
            //
        });

        Schema::table('tbl_luong',function ($table){
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
        Schema::drop('tbl_luong');
    }
}
