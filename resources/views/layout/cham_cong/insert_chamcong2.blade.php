@extends('master.master')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('/')}}">trang chủ</a></li>
<li class="breadcrumb-item active">chấm công</li>
@endsection

@section('content')
<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Chấm Công {{date('d-m-Y',strtotime(now()))}}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="d-flex justify-content-end">
                    <!-- right -->
                    <div class="pr-0 pb-2 d-sm-inline-block r-0"> 
                      <form action="{{route('themmoi.search')}}">
                          <div class=" input-group input-group-sm">
                    <!-- search -->
                      <input  type="text"<?php if(isset($_GET['search'])){echo 'value="'.$_GET['search'].'"';}?> name="search" class="form-control float-right" placeholder="Tìm nhân viên">
                    <div class="input-group-append"> 
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                      </form>
                    </div>
                    </div>
                  </div>
                </div>
                <div class="container table-responsive border p-0">
                  <table class="table table-sm  table-hover table-striped text-nowrap table-bordered">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Ảnh</th>
                      <th>Họ Và Tên</th>
                      <th>Giới tính</th>
                      <th>Ngày sinh</th>
                      <th>Số điện thoại</th>
                      <th>Email</th>
                      <th>Chấm công</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1; ?>
                    @foreach($nhanvien as $key=> $nv)
                    <tr>
                      <td>
                        {{($nhanvien->currentPage()-1)*$nhanvien->perPage()+$key+1}}
                      </td>
                      <td><img style="width: 50px; height: 75px;" src="{{asset('image')}}/{{$nv->anh_the}}" ></td>
                      <td>{{$nv->ten_nhanvien}}</td>
                      <td> @if($nv->gioi_tinh==1) Nam @else Nữ @endif </td>
                      <td>{{$nv->ngay_sinh}}</td>
                      <td>{{$nv->sdt}}</td>
                      <td>{{$nv->email}}</td>
                      <td>  
                        <!-- những nv chưa checkin||checkout trong ngày -->
                            @foreach($chua_check as $ck)
                              @if($ck->id_nhanvien==$nv->id_nhanvien)
                              <a href="{{route('themmoi.checkin',['id_nhanvien'=>$nv->id_nhanvien])}}" class="btn btn-sm btn-outline-danger" title="Checkin">
                                Giờ đến
                              </a>
                              @endif
                            @endforeach
                          <!-- những nv đã checkin  -->
                            @foreach($da_checkin as $ckin)
                              @if($ckin->id_nhanvien==$nv->id_nhanvien)
                              <a href="{{route('themmoi.checkout',['id'=>$ckin->id])}}" class="btn btn-sm btn-outline-info" title="Checkout">
                                Giờ về
                              </a>
                              @endif
                            @endforeach

                            @foreach($da_checkout as $ckout)
                              @if($ckout->id_nhanvien==$nv->id_nhanvien)      
                                Hoàn tất <i class="far fa-check-circle text-success" title="Xong"></i>
                              @endif
                            @endforeach
                    </td>  
                    </tr>
                    @endforeach   
                  </tbody>
                </table>
                </div>
                
              </div>
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  {{ $nhanvien->links() }}
                </ul> 
            </div>
              <!-- /.card-body -->
            </div>
          
            <!-- /.card -->
          </div>
        </div>
@endsection