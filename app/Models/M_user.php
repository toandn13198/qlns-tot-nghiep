<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_user extends Model
{
    protected $table = 'tbl_user';
    protected $primaryKey = 'id';
    protected $fillable = [ 'id','tai_khoan','mat_khau','phan_quyen'];
    public $timestamps = false;
}
