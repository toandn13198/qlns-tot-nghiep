<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_chucvu;
use App\Models\M_nhanvien;

class C_chucvu extends Controller
{
	public function index(){

    	$chucvu=M_chucvu::paginate(5);
    	return view('layout.chuc_vu.chucvu',['chucvu'=>$chucvu]);

    }

    public function insert(Request $Request){

          //kiem tra du lieu
        $validate=$Request->validate([
            'ten_chucvu'=>'required|max:110|min:5',
         ],[
            'ten_chucvu.required'=>'Tên không được để trống',
            'ten_chucvu.max'=>'Tên không quá 110 ký tự',

            'ten_chucvu.min'=>'Tên tối thiểu 5 ký tự.'
         ]);

    	 $chucvu=new M_chucvu;
    	 $chucvu->ten_chucvu=$Request->ten_chucvu;
         $chucvu->mo_ta=$Request->mo_ta;
    	 $check=$chucvu->save();
        toast('Thêm mới thành công!','success');
    	return redirect()->route('chucvu.index');
    }

    public function viewupdate($id_chucvu){

        $chucvu=M_chucvu::where('id_chucvu',$id_chucvu)->first();
        return view('layout.chuc_vu.update_chucvu',['chucvu'=>$chucvu]);
    }

    public function update(Request $Request){
        //kiem tra du lieu
        $validate=$Request->validate([
            'ten_chucvu'=>'required|max:110|min:5',
         ],[
            'ten_chucvu.required'=>'Tên không được để trống',
            'ten_chucvu.max'=>'Tên không quá 110 ký tự',
            'ten_chucvu.min'=>'Tên tối thiểu 5 ký tự.',
         ]);

        $obj=M_chucvu::find($Request->id_chucvu);
        $obj->ten_chucvu=$Request->ten_chucvu;
        $obj->mo_ta=$Request->mo_ta;
        $check=$obj->save();
        toast('Cập nhật thành công!','success');
        return redirect()->route('chucvu.index');

    }


    public function delete($id_chucvu){

        $check_nhanvien=M_nhanvien::where('chuc_vu',$id_chucvu)->count();
        if($check_nhanvien>0){
            return redirect()->back()->with('noti','Không thể xóa khi có nhân viên đang giữ chức vụ này, vui lòng thay đổi chức vụ của các nhân viên liên quan trước!');
        }
        $delete=M_chucvu::where('id_chucvu',$id_chucvu)->delete();
        toast('Xóa bản ghi thành công!','success');
        return redirect()->route('chucvu.index');
    }

    public function search(Request $Request){

        $search=M_chucvu::where('ten_chucvu','like','%'.$Request->search.'%')->paginate(5);
        return view('layout.chuc_vu.chucvu',['chucvu'=>$search]);

    }
}
