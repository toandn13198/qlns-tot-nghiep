@extends('master.master')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('/')}}">trang chủ</a></li>
<li class="breadcrumb-item active">thưởng phạt</li>
@endsection

@section('content')
<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Các Mức Phạt</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                 <div class="d-flex justify-content-between">
                  <div class="pb-2 pt-2 d-sm-inline-block">
                      <a class="btn btn-sm btn-primary" href="{{route('phat.viewinsert')}}" title="Thêm Mới">
                            Thêm mới
                      </a>
                    </div>
                    <!-- right -->
                    <div class="pb-2 pt-2 ml-5 d-sm-inline-block"> 
                      <form action="{{route('phat.search')}}">
                          <div class=" input-group input-group-sm">
                    <!-- search -->
                      <input  type="text"<?php if(isset($_GET['search'])){echo 'value="'.$_GET['search'].'"';}?> name="search" class="form-control float-right" placeholder="Tìm kiếm">
                    <div class="input-group-append"> 
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                      </form>
                    </div>
                    </div>
                  </div>
                </div>
                <div class="container p-0 table-responsive border">
                  <table class="table table-sm  table-hover text-nowrap table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Tên Mức</th>
                      <th>Khoảng muộn(phút)</th>
                      <th>Mức phạt</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                   
                    <?php $i=1; ?>
                    @foreach($thuong_phat as $tp)
                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{$tp->ten_muc_phat}}</td>
                      <td>{{$tp->muon_tu.(($tp->den_muon==NULL)? ' trở lên' :'-'.$tp->den_muon)}}</td>
                      <td>
                        @if($tp->don_vi_tinh==0)
                          {{number_format($tp->muc_phat).'  vnđ'}}
                        @else 
                          {{$tp->muc_phat." ngày"}}
                         @endif</td>
                      <td>
                          <a href="{{route('phat.viewupdate',['id_phat'=>$tp->id])}}" class="btn btn-sm" title="Chỉnh sửa">
                          <i class="far fa-edit" ></i> 
                          </a>
                          <a href="{{route('phat.delete',['id_phat'=>$tp->id])}}" class="btn btn-sm" title="Xóa bỏ" onclick="return confirm('Bạn có chắc muốn xóa bản ghi này ?')"">
                          <i class="fas fa-trash-alt" ></i>
                          </a>
                      </td>  
                    </tr>
                    @endforeach   
                  </tbody>
                </table>
                </div>
                
              </div>
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  {{ $thuong_phat->links() }}
                </ul> 
                
            </div>
              <!-- /.card-body -->
            </div>
          
            <!-- /.card -->
          </div>
        </div>
@endsection