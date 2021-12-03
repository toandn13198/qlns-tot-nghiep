<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class M_chucvu extends Model
{
    protected $table = 'tbl_chucvu';
    protected $primaryKey = 'id_chucvu';
    protected $fillable = ['id_chucvu', 'ten_chucvu'];
    public $timestamps = false;

    public function nhanvien(){
    	return $this->hasMany('App\Models\M_nhanvien','chuc_vu');
    }
}
