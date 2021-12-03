<?php

namespace App\Imports;


use App\Models\M_chamcong;
use App\Models\M_nhanvien;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Http\Controllers\C_chamcong;

class ChamcongImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    * 
    * 
    */

    public function headingRow(): int { 
        return 2; 
    }

    public function model(array $row)
    {
        if(!isset($row['cham_cong'])){
            return NULL;

        }
        $date=date('Y-m-d',strtotime($row['cham_cong']));
        $time=date('H:i:s',strtotime($row['cham_cong']));
        $thoi_gian_cham=date('Y-m-d H:i:s',strtotime($row['cham_cong']));
        // echo $time.'<br>';
        $check_id_nhanvien=M_nhanvien::where('id_nhanvien',$row['id'])->get();
        // echo $row['id'].'-'.count($check_id_nhanvien).'<br>';
        if(count($check_id_nhanvien)!=0){

            $check_ton_tai=M_chamcong::where('id_nhanvien',$row['id'])->whereDate('gio_den',$date)->get();
            
            if(count($check_ton_tai)==0){
                 C_chamcong::checkin($row['id'],$thoi_gian_cham);

            }else if($check_ton_tai->first()->gio_ve==NULL){
                $id_cham_cong=$check_ton_tai->first()->id;
                C_chamcong::checkout($id_cham_cong,$thoi_gian_cham);
            }else{};

        }
        
        // echo count($check);
         // return new M_chamcong([
            
         // ]);
    }
}
