<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::group(['prefix' => 'admin'], function() {
    //
});
//trang chủ
Route::get('/','C_index@index')->name('/')->middleware('login');
// phong ban
Route::prefix('phongban')->middleware('login')->group(function () {
    Route::get('index','C_phongban@index')->name('phongban.index');
    Route::get('viewinsert',['as'=>'phongban.viewinsert',function () {
        return view('layout.phong_ban.insert_phongban');
    }]);
    Route::post('insert','C_phongban@insert')->name('phongban.insert');
    Route::get('delete/{id_phong}','C_phongban@delete')->name('phongban.delete');
    Route::get('{id_phong}/viewupdate','C_phongban@viewupdate')->name('phongban.viewupdate');
    Route::post('update','C_phongban@update')->name('phongban.update');
    Route::get('search','C_phongban@search')->name('phongban.search');
});


// chuc vu
Route::prefix('chucvu')->middleware('login')->group(function () {

    Route::get('index','C_chucvu@index')->name('chucvu.index');
    Route::get('viewinsert',function () {
        return view('layout.chuc_vu.insert_chucvu');
    })->name('chucvu.viewinsert');
    Route::post('insert','C_chucvu@insert')->name('chucvu.insert');
    Route::get('{id_chucvu}/viewupdate','C_chucvu@viewupdate')->name('chucvu.viewupdate');
    Route::post('update','C_chucvu@update')->name('chucvu.update');
    Route::get('delete/{id_chucvu}','C_chucvu@delete')->name('chucvu.delete');
    Route::get('search','C_chucvu@search')->name('chucvu.search');
});


//nhan vien
Route::prefix('nhanvien')->middleware('login')->group(function (){

    Route::get('index','C_nhanvien@index')->name('nhanvien.index');
    Route::get('viewinsert','C_nhanvien@insertform')->name('nhanvien.viewinsert');
    Route::post('insert','C_nhanvien@insert')->name('nhanvien.insert');
    Route::get('{id_nhanvien}/viewupdate','C_nhanvien@viewupdate')->name('nhanvien.viewupdate');
    Route::post('update','C_nhanvien@update')->name('nhanvien.update');
    Route::get('delete/{id_nhanvien}','C_nhanvien@delete')->name('nhanvien.delete');
    Route::get('search','C_nhanvien@search')->name('nhanvien.search');
});

//cham cong
Route::prefix('chamcong')->middleware('login')->group(function (){

    //them moi
    Route::get('themmoi/index','C_chamcong@viewinsert')->name('themmoi.index');
    Route::get('{id_nhanvien}/checkin','C_chamcong@checkin')->name('themmoi.checkin');
    Route::get('{id}/checkout','C_chamcong@checkout')->name('themmoi.checkout');
    Route::get('themmoi/search','C_chamcong@search')->name('themmoi.search');
    //lich su
    Route::get('lichsu/index','C_chamcong@history')->name('lichsu.index');
    //nhap file
    Route::get('nhapdulieu/index','C_chamcong@viewimportfile')->name('nhapdulieu.index');
    Route::post('nhapdulieu/index','C_chamcong@importfile')->name('nhapdulieu.index');
    //cap nhat
    Route::get('update','C_chamcong@update')->name('lichsu.update');
});

// thuong phat
Route::prefix('thuongphat')->middleware('login')->group(function (){

    //PHAT MUON
    Route::get('phat/index','C_thuongphat@index')->name('phat.index');
    Route::get('phat/viewinsert','C_thuongphat@viewinsert')->name('phat.viewinsert');
    Route::post('phat/insert','C_thuongphat@insert')->name('phat.insert');
    Route::get('{id_phat}/viewupdate','C_thuongphat@viewupdate')->name('phat.viewupdate');
    Route::post('phat/update','C_thuongphat@update')->name('phat.update');
    Route::get('phat/delete/{id_phat}','C_thuongphat@delete')->name('phat.delete');
    Route::get('phat/search','C_thuongphat@search')->name('phat.search');
});


//bang luong
Route::prefix('luong')->middleware('login')->group(function (){
    Route::get('index','C_tinhluong@index')->name('luong.index');
});
//tai khoan
Route::prefix('user')->middleware('login')->group(function (){

    Route::get('index','C_login@taikhoan')->name('user.index');
    Route::get('viewinsert','C_login@viewinsert')->name('user.viewinsert');
    Route::post('insert','C_login@insert')->name('user.insert');
    Route::get('viewupdate/{id}','C_login@viewupdate')->name('user.viewupdate');
    Route::post('update','C_login@update')->name('user.update');
    Route::get('delete/{id}','C_login@delete')->name('user.delete');
    Route::get('search','C_login@search')->name('user.search');

});

//login
Route::get('login','C_login@index')->name('login.index');
Route::post('login/check','C_login@login')->name('login');
Route::get('loguot','C_login@logout')->name('logout');


//ajax
Route::get('getIdPhongBan','C_nhanvien@getPhongBan')->name('getIdPhongBan');