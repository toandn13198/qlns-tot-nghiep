<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_chamcong;

class C_tinhluong extends Controller
{
    //
    public function index(Request $Request)
    {
        //SELECT ten_nhanvien , tbl_cham_cong.id_nhanvien ,SUM(tbl_cham_cong.so_cong) as 'ngay_cong_thuc',SUM(tbl_cham_cong.bi_phat) AS 'tong_tien_phat' FROM tbl_nhanvien INNER JOIN tbl_cham_cong ON tbl_nhanvien.id_nhanvien = tbl_cham_cong.id_nhanvien WHERE MONTH(tbl_cham_cong.gio_den)=6 GROUP BY tbl_cham_cong.id_nhanvien

        $data_luong=array();
        if(isset($Request->ngay)&&$Request->ngay!=''){
            $thangnam=explode('/',$Request->ngay);
            $thang=$thangnam[0];
            $nam=$thangnam[1];

             $data_cham_cong=M_chamcong::select('tbl_nhanvien.id_nhanvien','ten_nhanvien','luong_cung',M_chamcong::raw('SUM(tbl_cham_cong.so_cong) as tong_so_cong'),M_chamcong::raw('SUM(tbl_cham_cong.bi_phat) as tong_tien_phat'))
                ->join('tbl_nhanvien','tbl_nhanvien.id_nhanvien','=','tbl_cham_cong.id_nhanvien')
                ->whereYear('tbl_cham_cong.gio_den',$nam)
                ->whereMonth('tbl_cham_cong.gio_den',$thang)
                ->groupBy('tbl_cham_cong.id_nhanvien','tbl_nhanvien.ten_nhanvien','luong_cung','tbl_nhanvien.id_nhanvien')
                ->get();
            $so_ngay_cong_thang=so_ngay_cong_thang($thang,$nam);
            

            foreach ($data_cham_cong as $key => $value) {
                $data_luong[$key]=$value->toArray();
                $tien_luong_thang=ceil($value->luong_cung/$so_ngay_cong_thang*$value->tong_so_cong);
                $data_luong[$key]['tien_luong_thang']=$tien_luong_thang;
                $data_luong[$key]['so_ngay_cong_thang']=$so_ngay_cong_thang;
                $data_luong[$key]['thuc_linh']=$tien_luong_thang-$value->tong_tien_phat;
            }     

        // echo '<pre>';
        // var_dump($data_luong);
        // echo '</pre>';
        // dd();
        }
       
        return view('layout.tinh_luong.luong',['data'=>$data_luong]);
    }
}
