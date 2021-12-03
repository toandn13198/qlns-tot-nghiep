<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_chamcong;
use App\Models\M_phongban;
use App\Models\M_nhanvien;
use App\Models\M_thuongphat;
use App\Imports\ChamcongImport;
use Maatwebsite\Excel\Facades\Excel;
use DateTime;

class C_chamcong extends Controller
{
   
  //   public function viewinsert2(Request $Request){

		// date_default_timezone_set('Asia/Ho_Chi_Minh');
       
  //   	if(isset($Request->date)&&$Request->date!=session('ngay_cham')){
  //   		session(['ngay_cham'=>$Request->date]);
  //   		toast('Chọn ngày thành công !','success');
  //   	}elseif(!isset($Request->date)&&!session()->has('ngay_cham')){
  //   		session(['ngay_cham'=>date('Y-m-d')]);
  //   	}

  //   	$doi_cham=M_nhanvien::select('id_nhanvien','ten_nhanvien','anh_the')->whereNotIn('id_nhanvien',M_chamcong::select('id_nhanvien')->whereDate('ngay_cham_cong',session('ngay_cham'))->get()->toArray())->get();
  //   	// echo '<pre>'; var_dump($dacham); echo '</pre>';
  //   	$da_cham=M_nhanvien::select('id_nhanvien','ten_nhanvien')->whereIn('id_nhanvien',M_chamcong::select('id_nhanvien')->whereDate('ngay_cham_cong',session('ngay_cham'))->get()->toArray())->get();

  //   	 return view('layout.cham_cong.insert_chamcong',['doicham'=>$doi_cham,'dacham'=>$da_cham]);
  //   }


    public function viewinsert(){

        //ds nv
        $nhanvien=M_nhanvien::paginate(10);
        // ds nv chua check in trong ngay
        $chua_check=M_nhanvien::whereNotIn('id_nhanvien',M_chamcong::select('id_nhanvien')->whereDate('gio_den',date('Y-m-d'))->get()->toArray())->get();
        // ds nv da checkin trong ngay
        $da_checkin=M_chamcong::whereDate('gio_den',date('Y-m-d'))->where('trang_thai',0)->get();
        // ds nv da hoan tat check in/out trong ngay
        $da_checkout=M_chamcong::whereDate('gio_den',date('Y-m-d'))->where('trang_thai',1)->get();
         return view('layout.cham_cong.insert_chamcong2',['nhanvien'=>$nhanvien,'da_checkin'=>$da_checkin,'da_checkout'=>$da_checkout,'chua_check'=>$chua_check]);
    }   

    public static function checkin($id_nhanvien,$thoi_gian='',$ret_id=false,$ud_id=''){

        if($thoi_gian!=''){
            $input_gio_vao=$thoi_gian;

        }else{
            //set thoi gian
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $input_gio_vao=now();
        }

        $gio_den_mac_dinh=date('Y-m-d',strtotime($input_gio_vao)).'08:30:00';
        $thang_input=date('m',strtotime($input_gio_vao));
        $nam_input=date('Y',strtotime($input_gio_vao));
        

        //obj cham cong
        if($ud_id!=''){
             $cham_cong=M_chamcong::find($ud_id);
        }else{
            $cham_cong=new M_chamcong;
        }
        
        $cham_cong->gio_den=$input_gio_vao;
        $cham_cong->id_nhanvien=$id_nhanvien;
        $cham_cong->trang_thai=0;
        $cham_cong->so_cong=0.5;
        $cham_cong->bi_phat=0;

        //cac thong tin phu can lay cho //tinh tien phat
        $phut_muon=so_phut_lech($gio_den_mac_dinh,$input_gio_vao);
        $so_ngay_cong_thang=so_ngay_cong_thang($thang_input,$nam_input);
        $luong_cung=M_nhanvien::select('luong_cung')->where('id_nhanvien',$id_nhanvien)->get()->first()->luong_cung;
        //$obj_phat=M_thuongphat::get();
        

        //tinh muc phat
        $obj_phat=M_thuongphat::where('muon_tu','<=',$phut_muon)
                                          ->where('den_muon','>',$phut_muon)
                                          ->get()->first();
        if($obj_phat==NULL){
        //thu loc xem co phai bock co den_muon=NULL
            $obj_phat=M_thuongphat::where('muon_tu','<=',$phut_muon)
                                          ->where('den_muon',NULL)
                                          ->get()->first();
        }
        if($obj_phat==NULL){
            //xac nhan khong bi phat 

        }else if($obj_phat->don_vi_tinh==0){
                //co bi phat va tinh tien phat
            $cham_cong->bi_phat=$obj_phat->muc_phat;
        }else{
            //thuoc loại đi muộn quá bị trừ nửa ngày công
             $cham_cong->bi_phat=0;
             $cham_cong->so_cong=0;
        }
        // echo $phut_muon;
        // echo 'muc phat='.$cham_cong->bi_phat;
        // dd($obj_phat);

        $cham_cong->save();
        if($ret_id==true){
            return $cham_cong->id;
        }
        if($thoi_gian!=''){
            
        }else{
            toast(' Đã chấm công lúc '.date('H:i:s',strtotime($input_gio_vao)),'success');
            return redirect()->back();
        }
        
    }

    public static function checkout($id,$thoi_gian=''){


        if($thoi_gian!=''){
             $input_gio_ve=$thoi_gian;
         }else{
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $input_gio_ve=now();
         }
        
        $gio_ve_mac_dinh=date('Y-m-d',strtotime($input_gio_ve)).'17:30:00';
        $thang_input=date('m',strtotime($input_gio_ve));
        $nam_input=date('Y',strtotime($input_gio_ve));

        $cham_cong=M_chamcong::find($id);
        $cham_cong->gio_ve=$input_gio_ve;
        $cham_cong->so_cong+=0.5;
        $cham_cong->trang_thai=1;

        //cac thong tin phu can lay cho //tinh tien phat
        $phut_muon=so_phut_lech($input_gio_ve,$gio_ve_mac_dinh);
        $so_ngay_cong_thang=so_ngay_cong_thang($thang_input,$nam_input);
        $luong_cung=M_nhanvien::select('luong_cung')->where('id_nhanvien',$cham_cong->id_nhanvien)->get()->first()->luong_cung;
        //tinh muc phat
        $obj_phat=M_thuongphat::where('muon_tu','<=',$phut_muon)
                                          ->where('den_muon','>',$phut_muon)
                                          ->get()->first();
        if($obj_phat==NULL){
        //thu loc xem co phai bock co den_muon=NULL
            $obj_phat=M_thuongphat::where('muon_tu','<=',$phut_muon)
                                          ->where('den_muon',NULL)
                                          ->get()->first();
        }
        if($obj_phat==NULL){
            //xac nhan khong bi phat 

        }else if($obj_phat->don_vi_tinh==0){
                //co bi phat va tinh tien phat
            $cham_cong->bi_phat+=$obj_phat->muc_phat;
        }else{
            //thuộc loại về sớm ở mức phạt bị trừ nửa công nên k trừ tiền nữa trừ luôn ngày công cho nó nhớ:))
             $cham_cong->bi_phat+=0;
             $cham_cong->so_cong+=0;
        }
        $cham_cong->save();

        if($thoi_gian==''){
            
            toast(' Hoàn tất chấm công !','success');
            return redirect()->back();
        }
        
    }

    public function search(Request $Request){
            
        $chua_check=M_nhanvien::whereNotIn('id_nhanvien',M_chamcong::select('id_nhanvien')->whereDate('gio_den',date('Y-m-d'))->get()->toArray())->get();
        // ds nv da checkin trong ngay
        $da_checkin=M_chamcong::whereDate('gio_den',date('Y-m-d'))->where('trang_thai',0)->get();
        // ds nv da hoan tat check in/out trong ngay
        $da_checkout=M_chamcong::whereDate('gio_den',date('Y-m-d'))->where('trang_thai',1)->get();
        $search=M_nhanvien::where('ten_nhanvien','like','%'.$Request->search.'%')
                            ->orWhere('que_quan','like','%'.$Request->search.'%')
                            ->orWhere('sdt','like','%'.$Request->search.'%')
                            ->orWhere('email','like','%'.$Request->search.'%')
                            ->paginate(10);
        return view('layout.cham_cong.insert_chamcong2',['nhanvien'=>$search,'da_checkin'=>$da_checkin,'da_checkout'=>$da_checkout,'chua_check'=>$chua_check]);
    }

    public function history(Request $Request){

        $phongban=M_phongban::get();
        $nhanvien=M_nhanvien::where('phong_ban',$Request->phongban)->get();
        $data=array();
        if((isset($Request->ngay)&&$Request->ngay!='')&&(isset($Request->nhanvien)&&$Request->nhanvien!='')){
            $thangnam=explode('/',$Request->ngay);
            $thang=$thangnam[0];
            $nam=$thangnam[1];
            //$tong_ngay_trong_thang=cal_days_in_month(CAL_GREGORIAN, $thang, $nam);//local
            $tong_ngay_trong_thang=date('t', mktime(0, 0, 0, $thang, 1, $nam));//server deploy
            $so_ngay_cong_thang=so_ngay_cong_thang($thang,$nam);
           

            $cham_cong=M_chamcong::whereYear('gio_den',$nam)
                                    ->whereMonth('gio_den',$thang)
                                    ->where('id_nhanvien',$Request->nhanvien)
                                    ->orderBy('gio_den','ASC')
                                    ->get();
            for($i=1;$i<=$tong_ngay_trong_thang;$i++){
                $date=$nam.'-'.$thang.'-'.(($i<10) ? '0'.$i : $i);
                $gio_den_mac_dinh=$date.'08:30:00';
                $gio_ve_mac_dinh=$date.'17:30:00';

                        $data[$i]['id']=NULL;
                        $data[$i]['id_nhanvien']=NULL;
                        $data[$i]['gio_den']=NULL;
                        $data[$i]['gio_ve']=NULL;
                        $data[$i]['trang_thai']=NULL;
                        $data[$i]['ten_ngay']=ten_ngay_trong_tuan($date);
                        $data[$i]['so_phut_di_muon']=NULL;
                        $data[$i]['so_phut_ve_som']=NULL;
                        $data[$i]['bi_phat']=NULL;
                        $data[$i]['so_cong']=0;
                        $data[$i]['ngay_cham']=$date;

                foreach($cham_cong as $key=> $value){
                    $dateDB=date("Y-m-d", strtotime($value['gio_den']));
                    // echo $i.'/'.$date.'('.strtotime($date).')'.'/'.$dateDB.'('.strtotime($dateDB).')'.'<br>';

                    if(strtotime($date)==strtotime($dateDB)){

                        $data[$i]=$value->toArray();
                        $data[$i]['ngay_cham']=$date;
                        $data[$i]['ten_ngay']=ten_ngay_trong_tuan($date);
                        $data[$i]['so_phut_di_muon']=so_phut_lech($gio_den_mac_dinh,$value['gio_den']);
                        if($value['gio_ve']!=NULL){
                            $data[$i]['so_phut_ve_som']=so_phut_lech($value['gio_ve'],$gio_ve_mac_dinh);
                        }else{
                            $data[$i]['so_phut_ve_som']=NULL;
                        }
                        
                       
                    }
                }
            }
                
            
        }
       
         return view('layout.cham_cong.lichsu_chamcong',['phongban'=>$phongban,'nhanvien'=>$nhanvien,'data'=>$data]);

    }


    public function viewimportfile()
    {
        return view('layout.cham_cong.importfile');
    }

    public function importfile(Request $Request)
    {
        // $validate=$Request->validate([
        //     'file_cham_cong'=>'required|mimes:xlsx,csv,xls',
        // ],[
        //     'file_cham_cong.mimes'=>'Chỉ chấp nhận file định dạng CSV, XLSX,XLS',
        //     'file_cham_cong.required'=>'Chưa chọn file dữ liệu.',
        // ]);

        $import=Excel::import(new ChamcongImport, Request()->file('file_cham_cong'));
        if($import==true){
            toast('Nhập file thành công!','success');
           
        }else if($import==null){
            toast('Có lỗi với file dữ liệu!','warning');
        }
         return redirect()->back();
              
    }

    public function update(Request $Request)
    {


        $gio_den=$Request->time_start;
        $gio_ve=$Request->time_end;
        $ngay=$Request->date;
        $id_nhanvien=$Request->id_nhanvien;
        $id_chamcong=$Request->id;
        if(strtotime($gio_den)>strtotime($gio_ve)){
            toast(' Giờ đến không được lớn hơn giờ về','warning');
            return redirect()->back();
        }

        $input_gio_vao=$ngay.' '.$gio_den.':00';
        $input_gio_ve=$ngay.' '.$gio_ve.':00';

        if($id_chamcong==''){
            //chua co cham cong cũ=>tạo mới
            if($gio_den!=''){
                $id_chamcong=$this->checkin($id_nhanvien,$input_gio_vao,true);
            }
            if($gio_ve!=''){
                $this->checkout($id_chamcong,$input_gio_ve);
            }

        }else{//da co cham cong cũ=> cập nhật
            
            if($gio_den==''&&$gio_ve==''){//nếu cả 2 input deu ''
                M_chamcong::find($id_chamcong)->delete();
            }else{//1 trong 2 input bi thieu

                if($gio_den!=''){
                    $this->checkin($id_nhanvien,$input_gio_vao,false,$id_chamcong);
                }else{
                    //neu gio vao NULL thi tuc là chỉ check 1 lần trong ngày=> coi gio ve là checkin va gio ve cu =NULL
                    $this->checkin($id_nhanvien,$input_gio_ve,false,$id_chamcong);
                    $cham_cong=M_chamcong::find($id_chamcong);
                    $cham_cong->gio_ve=NULL;
                    $cham_cong->save();
                }

                if($gio_ve!=''){
                    $this->checkout($id_chamcong,$input_gio_ve);
                }else{
                    $cham_cong=M_chamcong::find($id_chamcong);
                    $cham_cong->gio_ve=NULL;
                    $cham_cong->so_cong-=0.5;
                    $cham_cong->save();

                }
            }
            
        }
        toast('Cập nhật chấm công '.$ngay.' thành công!','success');
        return redirect()->back();
    }

 
}




//tinh tien phat
        // foreach($obj_phat as $pm){
        //         if($pm->muon_tu <= $phut_muon && $phut_muon < $pm->den_muon){
        //             echo $pm->ten_muc_phat;
        //             echo 'muon'.$phut_muon;

        //             if($pm->don_vi_tinh==0){
        //                 $cham_cong->bi_phat=$pm->muc_phat;
        //             }else{  
        //                  $cham_cong->bi_phat=(int)ceil($luong_cung/$so_ngay_cong_thang*$pm->muc_phat);
        //             };

        //         }
        //         if($pm->muon_tu <= $phut_muon && $pm->den_muon==NULL){
        //             echo $pm->ten_muc_phat;
        //             echo 'muon'.$phut_muon;
        //             if($pm->don_vi_tinh==0){
        //                 $cham_cong->bi_phat=$pm->muc_phat;
        //             }else{
        //                 $cham_cong->bi_phat=(int)ceil($luong_cung/$so_ngay_cong_thang*$pm->muc_phat);
        //             };
        //         }  
        // }
        //end tinh tien phat
 
 
