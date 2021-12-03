@extends('master.master')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('/')}}">trang chủ</a></li>
<li class="breadcrumb-item active">phòng ban</li>
@endsection

@section('content')
<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Danh Sách Phòng Ban</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body ">
                @if(session('noti'))
                <div class="alert alert-danger" role="alert">
                  {{session('noti')}}
                </div>
                @endif
                <!-- car-tool -->
                <div class=" d-flex justify-content-between">
                  <!-- left -->
                    <div class="pb-2 pt-2 d-sm-inline-block">
                      <a class="btn btn-sm btn-primary" href="{{route('phongban.viewinsert')}}" title="Thêm Mới">
                            Thêm mới
                      </a>
                    </div>
                    <!-- right -->
                    <div class="pb-2 pt-2 ml-5 d-sm-inline-block"> 
                      <form action="{{route('phongban.search')}}">
                          <div class=" input-group input-group-sm">
                    <!-- search -->
                      <input  type="text"<?php if(isset($_GET['search'])){echo 'value="'.$_GET['search'].'"';}?> name="search" class="form-control float-right" placeholder="Tìm tên phòng">
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
                <div class="container table-responsive p-0 border">
                   <table class="table  table-sm table-hover text-nowrap table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Tên Phòng Ban</th>
                      <th>Mô Tả</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    @foreach($phongban as $key=> $phong)
                    <tr>
                      <td>{{($phongban->currentPage()-1)*$phongban->perPage()+$key+1}}</td>
                      <td>{{$phong->ten_phong}}</td>
                      <td>{!!$phong->mo_ta!!}</td>
                      <td>
                          <a href="{{route('phongban.viewupdate',['id_phong'=>$phong->id_phongban])}}" class="btn btn-sm" title="Chỉnh sửa">
                          <i class="far fa-edit" ></i> 
                          </a>
                          <a href="{{route('phongban.delete',['id_phong'=>$phong->id_phongban])}}" class="btn btn-sm" title="Xóa bỏ" onclick="return confirm('Bạn có chắc muốn xóa bản ghi này ?')"">
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
                  {{ $phongban->links() }}
                </ul> 
            </div>
              <!-- /.card-body -->
            </div>

          
            <!-- /.card -->
          </div>
        </div>
</div>
@endsection