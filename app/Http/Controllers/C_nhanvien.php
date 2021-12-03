<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_phongban;
use App\Models\M_chucvu;
use App\Models\M_nhanvien;
use App\Models\M_chamcong;


class C_nhanvien extends Controller
{
    public function index(){

    	$nhanvien=M_nhanvien::paginate(5);
    	$chucvu=M_chucvu::select('id_chucvu','ten_chucvu')->get();
    	$phongban=M_phongban::select('id_phongban','ten_phong')->get();
    	return view('layout.nhan_vien.nhanvien',['nhanvien'=>$nhanvien,'phongban'=>$phongban,'chucvu'=>$chucvu]);

    }

    public function insertform(){

    	$chucvu=M_chucvu::select('id_chucvu','ten_chucvu')->get();
    	$phongban=M_phongban::select('id_phongban','ten_phong')->get();
    	 return view('layout.nhan_vien.insert_nhanvien',['phongban'=>$phongban,'chucvu'=>$chucvu]);
    }

    public function insert(Request $Request){

    	 //test validate data
    	 $validate=$Request->validate([

    	 	'ten_nhanvien'=>'required|max:110|min:10',
            'ngay_sinh'=>'required|date',
            'que_quan'=>'required|max:110',
            'sdt'=>'required|numeric',
            'gioi_tinh'=>'required',
            'email'=>'required|max:110|email:rfc,dns',
            'phong_ban'=>"integer",
            'chuc_vu'=>'integer',
            'luong_cung'=>'required',
            'anh_the'=>'mimes:jpg,jpeg,png|max:2048'

    	 ],[

    	 	'ten_nhanvien.required'=>' Không được để trống ',
            'ngay_sinh.required'=>' Không được để trống ',
            'que_quan.required'=>' Không được để trống ',
            'sdt.required'=>' Không được để trống ',
            'gioi_tinh.required'=>' Không được để trống ',
            'email.required'=>' Không được để trống ',
            'luong_cung.required'=>' Không được để trống ',
            'anh_the.mimes'=>'Chỉ chấp nhận đuôi jpg, jpeg, png',
            'anh_the.max'=>'File ảnh không quá 2MB',


            'phong_ban.integer'=>'Phải chọn',
            'chuc_vu.integer'=>'Phải chọn',
            'sdt.numeric'=>'Phải là dạng số',

            'ten_nhanvien.max'=>' Tối đa 110 ký tự ',
            'que_quan.max'=>' Tối đa 110 ký tự ',
            'email.max'=>' Tối đa 110 ký tự ',
            'ten_nhanvien.min'=>' Tối thiểu 10 ký tự ',
            'gioi_tinh.boolean'=>' Không được để trống ',
            'ngay_sinh.date'=>'Sai định dạng ngày sinh',
            'email.email'=>'Sai định dạng email',

            'luong.numeric'=>'Phải là dạng số',

    	 ]);


         $obj=new M_nhanvien;
         $obj->ten_nhanvien=$Request->ten_nhanvien;
         $obj->ngay_sinh=$Request->ngay_sinh;
         $obj->que_quan=$Request->que_quan;
         $obj->sdt=(string)$Request->sdt;
         $obj->gioi_tinh=$Request->gioi_tinh;
         $obj->email=$Request->email;
         $obj->phong_ban=$Request->phong_ban;
         $obj->chuc_vu=$Request->chuc_vu;
         $obj->luong_cung=implode('',explode ( ',' , $Request->luong_cung));

    	 // upload anh the nhan vien
    	 $NameImg='';
    	 if($Request->hasFile('anh_the')){
    	 	$imgFile = $Request->file('anh_the');
			$NameImg = time().'_'.$imgFile->getClientOriginalName();
			$movePath = public_path('image');
			$imgFile->move($movePath, $NameImg);
    	 }
    	 // gan ten ten anh moi vao obj
    	$obj->anh_the=$NameImg;
    	$obj->save(); 
        toast('Thêm mới thành công!','success');
    	return redirect()->route('nhanvien.index');

     }

     public function viewupdate($id_nhanvien){

     	$nhanvien=M_nhanvien::where('id_nhanvien',$id_nhanvien)->first();
     	$chucvu=M_chucvu::select('id_chucvu','ten_chucvu')->get();
    	$phongban=M_phongban::select('id_phongban','ten_phong')->get();
    	return view('layout.nhan_vien.update_nhanvien',['nhanvien'=>$nhanvien,'chucvu'=>$chucvu,'phongban'=>$phongban]);

     }
     public function update(Request $Request){

         $validate=$Request->validate([

            'ten_nhanvien'=>'required|max:110|min:10',
            'ngay_sinh'=>'required|date',
            'que_quan'=>'required|max:110',
            'sdt'=>'required|numeric',
            'gioi_tinh'=>'required',
            'email'=>'required|max:110|email:rfc,dns',
            'phong_ban'=>"integer",
            'chuc_vu'=>'integer',
            'luong_cung'=>'required',
            'anh_the'=>'mimes:jpg,jpeg,png|max:2048'

         ],[

            'ten_nhanvien.required'=>' Không được để trống ',
            'ngay_sinh.required'=>' Không được để trống ',
            'que_quan.required'=>' Không được để trống ',
            'sdt.required'=>' Không được để trống ',
            'gioi_tinh.required'=>' Không được để trống ',
            'email.required'=>' Không được để trống ',
            'luong_cung.required'=>' Không được để trống ',
            'anh_the.mimes'=>'Chỉ chấp nhận đuôi jpg, jpeg, png',
            'anh_the.max'=>'File ảnh không quá 2M',


            'phong_ban.integer'=>'Phải chọn',
            'chuc_vu.integer'=>'Phải chọn',
            'sdt.numeric'=>'Phải là dạng số',

            'ten_nhanvien.max'=>' Tối đa 110 ký tự ',
            'que_quan.max'=>' Tối đa 110 ký tự ',
            'email.max'=>' Tối đa 110 ký tự ',
            'ten_nhanvien.min'=>' Tối thiểu 10 ký tự ',
            'gioi_tinh.boolean'=>' Không được để trống ',
            'ngay_sinh.date'=>'Sai định dạng ngày sinh',
            'email.email'=>'Sai định dạng email',

            'luong.numeric'=>'Phải là dạng số',

         ]);

    	 $obj=M_nhanvien::find($Request->id_nhanvien);
    	 $obj->ten_nhanvien=$Request->ten_nhanvien;
    	 $obj->ngay_sinh=$Request->ngay_sinh;
    	 $obj->que_quan=$Request->que_quan;
    	 $obj->sdt=(string)$Request->sdt;
    	 $obj->gioi_tinh=$Request->gioi_tinh;
    	 $obj->email=$Request->email;
    	 $obj->phong_ban=$Request->phong_ban;
    	 $obj->chuc_vu=$Request->chuc_vu;
    	 $obj->luong_cung=implode('',explode ( ',' , $Request->luong_cung));


    	 // upload anh the nhan vien mới
    	 $NameImg='';
    	 if($Request->hasFile('anh_the')){
    	 	//upload anh mới vào thư mục
    	 	$imgFile = $Request->file('anh_the');
			$NameImg = time().'_'.$imgFile->getClientOriginalName();
			$movePath = public_path('image');
			$imgFile->move($movePath, $NameImg);
			//
			// gan ten anh moi vao obj
    	 	$obj->anh_the=$NameImg;
    	 	//

    	 	//xoa bo anh cu trong thu muc lưu trữ
    	 	//get tên ảnh cũ của nhân viên id
    	 	$obj_img=M_nhanvien::select('anh_the')->where('id_nhanvien',$Request->id_nhanvien)->first();
			if($obj_img->anh_the != '' && file_exists(public_path('image/'.$obj_img->anh_the)))
			{
				unlink(public_path('image/'.$obj_img->anh_the));
			}
    	 }
    	 //thực hiện lưu thông tin vào database
    	 $check=$obj->save();
        toast('Cập nhật thành công!','success');
    	return redirect()->route('nhanvien.index');

     }

      public function delete($id_nhanvien){
      	//get tên ảnh cũ của nhân viên id
      	$obj_img=M_nhanvien::select('anh_the')->where('id_nhanvien',$id_nhanvien)->first();
        // xoa bỏ chấm công
        M_chamcong::where('id_nhanvien',$id_nhanvien)->delete();
      	//xóa bỏ bản ghi
        $delete=M_nhanvien::where('id_nhanvien',$id_nhanvien)->delete();
      
        //xoa bỏ anh cũ
        if($delete){
        	if($obj_img->anh_the != '' && file_exists(public_path('image/'.$obj_img->anh_the)))
			{
				unlink(public_path('image/'.$obj_img->anh_the));
			}
            toast('Xóa bản ghi thành công!','success');
        }else{
            toast('Có lỗi xảy ra!','error');
        }
        return redirect()->back();
    }

    public function search(Request $Request){
    	$strign=$Request->search;
    	$chucvu=M_chucvu::select('id_chucvu','ten_chucvu')->get();
    	$phongban=M_phongban::select('id_phongban','ten_phong')->get();
        $search=M_nhanvien::where('ten_nhanvien','like','%'.$Request->search.'%')
		        			->orWhere('que_quan','like','%'.$Request->search.'%')
		        			->orWhere('sdt','like','%'.$Request->search.'%')
		        			->orWhere('email','like','%'.$Request->search.'%')
		        			->paginate(5);
        													
         return view('layout.nhan_vien.nhanvien',['nhanvien'=>$search,'chucvu'=>$chucvu,'phongban'=>$phongban]);

    }

    public function getPhongBan(Request $Request)
    {
        $nhanvien=M_nhanvien::where('phong_ban',$Request->id_phong)->get();
        $result="<option value='0'>Chọn Nhân Viên </option>";
        foreach($nhanvien as $key => $nv){
            $result.= "<option value='".$nv->id_nhanvien."'>".$nv->ten_nhanvien."</option>";    
        }
        return $result;

    }
}
