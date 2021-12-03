@extends('master.master')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('/')}}">trang chủ</a></li>
<li class="breadcrumb-item active">chức vụ</li>
@endsection

@section('content')
<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Danh Sách Chức Vụ</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                 @if(session('noti'))
                <div class="alert alert-danger" role="alert">
                  {{session('noti')}}
                </div>
                @endif
                <div class="d-flex justify-content-between">
                  <div class="pb-2 pt-2 d-sm-inline-block">
                      <a class="btn btn-sm btn-primary" href="{{route('chucvu.viewinsert')}}" title="Thêm Mới">
                            Thêm mới
                      </a>
                    </div>
                    <!-- right -->
                    <div class="pb-2 pt-2 ml-5 d-sm-inline-block"> 
                      <form action="{{route('chucvu.search')}}">
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
                <!-- table -->
                <div class="container border p-0 table-responsive">
                  <table class="table table-sm table-hover text-nowrap table-striped">
                  <thead>
                    <tr>
                      <th style="">#</th>
                      <th>Tên chức vụ</th>
                      <th>Mô tả</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                 
                    @foreach($chucvu as $key=> $cv)
                    <tr>
                      <td>{{(($chucvu->currentPage()-1)*$chucvu->perPage())+$key+1}}</td>
                      <td>{{$cv->ten_chucvu}}</td>
                       <td>{{$cv->mo_ta}}</td>
                      <td>
                          <a href="{{route('chucvu.viewupdate',['id_chucvu'=>$cv->id_chucvu])}}" class="btn btn-sm" title="Chỉnh sửa">
                          <i class="far fa-edit" ></i> 
                          </a>
                          <a href="{{route('chucvu.delete',['id_chucvu'=>$cv->id_chucvu])}}" class="btn btn-sm" title="Xóa bỏ" onclick="return confirm('Bạn có chắc muốn xóa bản ghi này ?')"">
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
                  {{ $chucvu->links() }}
                </ul> 
                
            </div>
              <!-- /.card-body -->
            </div>
          
            <!-- /.card -->
          </div>
        </div>
@endsection