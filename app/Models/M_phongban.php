<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_phongban extends Model
{
    
    protected $table = 'tbl_phongban';
    protected $primaryKey = 'id_phongban';
    protected $fillable = ['id_phongban', 'ten_phong', 'mo_ta'];
    public $timestamps = false;

    public function nhanvien(){
    	return $this->hasMany('App\Models\M_nhanvien','phong_ban');
    }
}
