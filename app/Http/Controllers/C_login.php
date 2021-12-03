<?php

namespace App\Http\Controllers;

use App\Models\M_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class C_login extends Controller
{
    public function index()
    {
        return view('login.login');
    }

    public function login(Request $Request)
    {

        $Request->validate([
            'tai_khoan'=>'required',
            'mat_khau'=>'required',
        ],[
            'tai_khoan.required'=>'Không được để trống',
            'mat_khau.required'=>'Không được để trống',
        ]);

        $user=M_user::where(['tai_khoan'=>$Request->tai_khoan,'mat_khau'=>md5($Request->mat_khau),'phan_quyen'=>0])->first();
        if($user!=NULL){
            session()->put('user',$user);
            toast('Chào mừng '.$user->tai_khoan.' truy cập!','success');
            if(isset($Request->ghi_nho)){
                Cookie::queue('tai_khoan',$Request->tai_khoan,60*24);
                Cookie::queue('mat_khau',$Request->mat_khau,60*24);
            }else{
                Cookie::queue(Cookie::forget('tai_khoan'));
                Cookie::queue(Cookie::forget('mat_khau'));
            }
            return redirect()->route('/');
    
        }

        return redirect()->route('login.index')->with('err','Sai tài khoản hoặc mật khẩu');
    }

    public function taikhoan()
    {
        $user=M_user::paginate(10);
        return view('layout.tai_khoan.index',['user'=>$user]);
    }

    public function insert(Request $Request)
    {
        $Request->validate([
            'tai_khoan'=>'required',
            'mat_khau'=>'required',
            'email'=>'required|email',
            'phan_quyen'=>'integer',
            're_mat_khau'=>'required|same:mat_khau',
        ],[
            'tai_khoan.required'=>'Không được để trống',
            'mat_khau.required'=>'Không được để trống',
            'email.required'=>'Không được để trống',
            'email.email'=>'Không đúng định dạng emai',
            'phan_quyen.integer'=>'Phải chọn',
            're_mat_khau.required'=>'Không được để trống',
            're_mat_khau.same'=>'Nhập lại không đúng',
        ]);

        $user= new M_user;
        $user->tai_khoan=$Request->tai_khoan;
        $user->email=$Request->email;
        $user->mat_khau=md5($Request->mat_khau);
        $user->phan_quyen=$Request->phan_quyen;
        $user->save();
        toast('Thêm mới thành công!','success');
        return redirect()->route('user.index');
    }

    public function viewupdate($id){
        $user=M_user::where('id',$id)->first();
        return view('layout.tai_khoan.update',['user'=>$user]);
    }

    public function update(Request $Request)
    {
        $Request->validate([
            'tai_khoan'=>'required',
            'email'=>'email',
            'phan_quyen'=>'integer',
            're_mat_khau'=>'same:mat_khau',
        ],[
            'tai_khoan.required'=>'Không được để trống',
            'email.required'=>'Không được để trống',
            'email.email'=>'Không đúng định dạng emai',
            'phan_quyen.integer'=>'Phải chọn',
            're_mat_khau.same'=>'Nhập lại không đúng',
        ]);

        $user=M_user::find($Request->id);
        $user->tai_khoan=$Request->tai_khoan;
        $user->email=$Request->email;
        if($Request->mat_khau!=''){
            $user->mat_khau=md5($Request->mat_khau);
        }
        $user->phan_quyen=$Request->phan_quyen;
        $user->save();
        toast('Cập nhật thành công!','success');
        return redirect()->route('user.index');

    }

    public function delete($id)
    {
        // code...'
        M_user::where('id',$id)->delete();
        toast('Xóa bản ghi thành công!','success');
        return redirect()->route('user.index');

    }


    public function logout()
    {
        session()->forget('user');
        
        return redirect()->route('login.index')->with('noti','Đăng xuất thành công');
    }

     public function viewinsert()
    {
        return view('layout.tai_khoan.insert');
    }

     public function search(Request $Request)
    {
        $search=M_user::where('tai_khoan','like','%'.$Request->search.'%')
                        ->orWhere('email','like','%'.$Request->search.'%')->paginate(5);
        return view('layout.tai_khoan.index',['user'=>$search]);
    }


}
