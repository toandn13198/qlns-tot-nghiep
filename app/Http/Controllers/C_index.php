<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_chucvu;
use App\Models\M_nhanvien;
use App\Models\M_phongban;

class C_index extends Controller
{
    public function index() {
        $num_phongban=M_phongban::count();
        $num_nhanvien=M_nhanvien::count();
        $num_chucvu=M_chucvu::count();
        return view('layout.index',['phongban'=>$num_phongban,'chucvu'=>$num_chucvu,'nhanvien'=>$num_nhanvien]);
    }
}
