<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_chamcong extends Model
{
    protected $table = 'tbl_cham_cong';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'id_nhanvien','gio_den','gio_ve','ngay_cham_cong','so_cong','bi_phat'];
    public $timestamps = false;

 }
