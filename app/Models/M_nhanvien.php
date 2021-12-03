<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class M_nhanvien extends Model
{
    protected $table = 'tbl_nhanvien';
    protected $primaryKey = 'id_nhanvien';
    protected $fillable = ['id_nhanvien', 
						    'ten_nhanvien',
						    'anh_daidien',
						    'gioi_tinh',
						    'ngay_sinh',
						    'que_quan',
						    'sdt',
						    'phong_ban',
						    'chuc_vu',
						    'luong_cung',
						    ];
    public $timestamps = false;

    public function phongban()
    {
    	return $this->belongsTo('App\Models\M_phongban','phong_ban','id_phongban');
    }
    public function chucvu(){
    	return $this->belongsTo('App\Models\M_chucvu','chuc_vu','id_chucvu');
    }
   							
}
