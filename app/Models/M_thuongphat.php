<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_thuongphat extends Model
{
    //
     protected $table = 'tbl_thuong_phat';
    protected $primaryKey = 'id';
    protected $fillable = [ 'id','muon_tu den_muon','muc_phat','don_vi_tinh','ten_muc_phat'];
    public $timestamps = false;

}
