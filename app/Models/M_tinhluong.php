<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_tinhluong extends Model
{
    //
    protected $table = 'tbl_luong';
    protected $primaryKey = 'id';
    protected $fillable = [ 'id','id_nhanvien', 'ngay_tinh','tong_so_cong','tong_tien_luong','khau_tru'];
    public $timestamps = false;
}
