<?php
if (!function_exists('ten_ngay_trong_tuan')) {
 function ten_ngay_trong_tuan($ngay){

        $ten_ngay = '';
        $ngay_trong_tuan  = date('w', strtotime($ngay));
        switch ($ngay_trong_tuan) {
            case 1:
                $ten_ngay = 'Thứ hai';
                break;
            case 2:
                $ten_ngay = 'Thứ ba';
                break;
            case 3:
                $ten_ngay = 'Thứ tư';
                break;
            case 4:
                $ten_ngay = 'Thứ năm';
                break;
            case 5:
                $ten_ngay = 'Thứ sáu';
                break;
            case 6:
                $ten_ngay = 'Thứ bảy';
                break;
            case 0:
                $ten_ngay = 'Chủ nhật';
                break;
        }
        return $ten_ngay;
    }
}

if (!function_exists('so_ngay_cong_thang')) {
	function so_ngay_cong_thang($thang,$nam){
        //$tong_ngay_trong_thang=cal_days_in_month(CAL_GREGORIAN, $thang, $nam);//local
        $tong_ngay_trong_thang=date('t', mktime(0, 0, 0, $thang, 1, $nam)); //server deploy

        $so_ngay_thu_7=dem_so_ngay_trong_thang(6,$thang,$nam);
        $so_ngay_cn=dem_so_ngay_trong_thang(7,$thang,$nam);
        return $tong_ngay_trong_thang-$so_ngay_cn;

    }

}


if (!function_exists('dem_so_ngay_trong_thang')) {
	function dem_so_ngay_trong_thang($ten,$thang,$nam){
        $so_ngay=0;
        //$tong_ngay_thang=cal_days_in_month(CAL_GREGORIAN, $thang, $nam);//local
        $tong_ngay_thang=date('t', mktime(0, 0, 0, $thang, 1, $nam)); //server deploy
        for($i=1;$i<=$tong_ngay_thang;$i++)
            if(date('N',strtotime($nam.'-'.$thang.'-'.$i))==$ten)
                $so_ngay++;
        return $so_ngay;
	}
}


  

if (!function_exists('so_phut_lech')) {
 function so_phut_lech($tg_truoc, $tg_sau) {
        $dteStart = new DateTime($tg_truoc);
        $dteEnd   = new DateTime($tg_sau);
        $total_minutes = 0;
        if($dteStart < $dteEnd) {
            $dteDiff = $dteStart->diff($dteEnd);
            $total_time = $dteDiff->format("%H:%I");
            $arr_time = explode(':', $total_time);
            $total_minutes = ((int)$arr_time[0] * 60) + (int)$arr_time[1];
        }
        return $total_minutes;
    }
}

 ?>