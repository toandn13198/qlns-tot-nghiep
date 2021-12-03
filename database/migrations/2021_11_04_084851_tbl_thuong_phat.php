<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblThuongPhat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tbl_thuong_phat', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('muon_tu');
            $table->integer('den_muon')->nullable();
            $table->float('muc_phat');
            $table->string('ten_muc_phat');
            $table->tinyInteger('don_vi_tinh');

            //
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
        Schema::drop('tbl_thuong_phat');
    }
}
