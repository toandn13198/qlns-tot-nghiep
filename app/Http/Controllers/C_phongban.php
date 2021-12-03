<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_phongban;
use App\Models\M_nhanvien;
Use Alert;

class C_phongban extends Controller
{
    public function index(){
    	$phongban=M_phongban::paginate(5);
    	return view('layout.phong_ban.phongban',['phongban'=>$phongban]);

    }
    public function insert(Request $Request){

        //kiem tra du lieu
        $validate=$Request->validate([
            'ten_phongban'=>'required|max:110|min:5',
         ],[
            'ten_phongban.required'=>'Tên không được để trống',
            'ten_phongban.max'=>'Tên không quá 110 ký tự',
             'ten_phongban.min'=>'Tên tối thiểu 5 ký tự',

         ]);

    	 $obj=new M_phongban;
    	 $obj->ten_phong=$Request->ten_phongban;
    	 $obj->mo_ta=$Request->mo_ta;
    	 $check=$obj->save();

         if($check){
            toast('Thêm mới thành công!','success');
        }else{
            toast('Có lỗi xảy ra!','error');
        }
    	 return redirect()->route('phongban.index');
    }

    public function delete($id_phong){

        $check_nhanvien=M_nhanvien::where('phong_ban',$id_phong)->count();
        if($check_nhanvien>0){
            return redirect()->back()->with('noti','Không thể xóa khi có nhân viên trong phòng, vui lòng thay đổi phòng ban của các nhân viên liên quan!');
        }
        $delete=M_phongban::where('id_phongban',$id_phong)->delete();

        if($delete){
            toast('Xóa bản ghi thành công!','success');
        }else{
            toast('Có lỗi xảy ra!','error');
        }
        return redirect()->back();
    }
    public function viewupdate($id_phong){
        $phongban=M_phongban::where('id_phongban',$id_phong)->first();
        return view('layout.phong_ban.update_phongban',['phongban'=>$phongban]);
    }
    public function update(Request $Request){

         //kiem tra du lieu
        $validate=$Request->validate([
            'ten_phongban'=>'required|max:110|min:5',
         ],[
            'ten_phongban.required'=>'Tên không được để trống',
            'ten_phongban.max'=>'Tên không quá 110 ký tự',
            'ten_phongban.min'=>'Tên tối thiểu 5 ký tự',
         ]);

        $obj=M_phongban::find($Request->id_phong);
         $obj->ten_phong=$Request->ten_phongban;
         $obj->mo_ta=$Request->mo_ta;
         $check=$obj->save();
         if($check){
            toast('Cập nhật thành công!','success');
        }else{
            toast('Có lỗi xảy ra!','error');
        }
         return redirect()->route('phongban.index');

    }
    public function search(Request $Request){

        $search=M_phongban::where('ten_phong','like','%'.$Request->search.'%')->paginate(5);
        return view('layout.phong_ban.phongban',['phongban'=>$search]);

    }

    
}
