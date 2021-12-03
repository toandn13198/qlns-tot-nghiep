<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_thuongphat;

class C_thuongphat extends Controller
{
    //
    public function index()
    {
        $thuong_phat=M_thuongphat::paginate(10);
        return view('layout.thuong_phat.thuongphat',['thuong_phat'=>$thuong_phat]);
    }

    public function viewinsert()
    {
        return view('layout.thuong_phat.insert_thuongphat');
    }

    public function insert(Request $Request)
    {
       $thuong_phat=new M_thuongphat;
       $thuong_phat->muon_tu=$Request->muon_tu;
       $thuong_phat->den_muon=$Request->den_muon;
       $thuong_phat->ten_muc_phat=$Request->ten_muc_phat;
       $thuong_phat->muc_phat=implode('',explode ( ',' , $Request->muc_phat));
       $thuong_phat->don_vi_tinh=$Request->don_vi_tinh;
       $thuong_phat->save();
       toast('Thêm mới thành công!','success');
       return redirect()->route('phat.index');
    } 

    public function viewupdate($id_thuongphat)
    {
        $thuongphat=M_thuongphat::where('id',$id_thuongphat)->first();
        return view('layout.thuong_phat.update_thuongphat',['thuongphat'=>$thuongphat]);
    }

    public function update(Request $Request)
    {
        $thuong_phat=M_thuongphat::find($Request->id);
        $thuong_phat->muon_tu=$Request->muon_tu;
        $thuong_phat->den_muon=$Request->den_muon;
        $thuong_phat->ten_muc_phat=$Request->ten_muc_phat;
        $thuong_phat->muc_phat=implode('',explode ( ',' , $Request->muc_phat));
        $thuong_phat->don_vi_tinh=$Request->don_vi_tinh;
        $thuong_phat->save();
        toast('Cập nhật thành công!','success');
        return redirect()->route('phat.index');
    }

    public function delete($id)
    {
        M_thuongphat::where('id',$id)->delete();
        toast('Xóa bản ghi thành công!','success');
        return redirect()->route('phat.index');
    }

    public function search(Request $Request){

        $search=M_thuongphat::where('ten_muc_phat','like','%'.$Request->search.'%')
                                ->orWhere('muc_phat','like','%'.$Request->search.'%')
                                ->orWhere('muon_tu','like','%'.$Request->search.'%')
                                ->orWhere('den_muon','like','%'.$Request->search.'%')
                                ->paginate(5);
        return view('layout.thuong_phat.thuongphat',['thuong_phat'=>$search]);

    }

}
