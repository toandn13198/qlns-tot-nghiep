<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblNhanvien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tbl_nhanvien', function (Blueprint $table) {
            $table->increments('id_nhanvien');
            $table->string('ten_nhanvien');
            $table->string('anh_the')->nullable();
            $table->tinyInteger('gioi_tinh');
            $table->date('ngay_sinh');
            $table->string('que_quan');
            $table->text('sdt')->nullable();
            $table->string('email');
            $table->integer('phong_ban')->unsigned();
            $table->integer('chuc_vu')->unsigned();
            $table->float('luong_cung');

            //
        });

        Schema::table('tbl_nhanvien', function (Blueprint $table) {
            $table->foreign('phong_ban')->references('id_phongban')->on('tbl_phongban');
            $table->foreign('chuc_vu')->references('id_chucvu')->on('tbl_chucvu');
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
        Schema::drop('tbl_nhanvien');
    }
}
