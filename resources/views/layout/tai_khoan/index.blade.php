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
                <h3 class="card-title">Danh Sách Tài Khoản</h3>
                </div> 
              <!-- /.card-header -->
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <div class="pb-2 pt-2 d-sm-inline-block">
                      <a class="btn btn-sm btn-primary" href="{{route('user.viewinsert')}}" title="Thêm Mới">
                            Thêm mới
                      </a>
                    </div>
                    <!-- right -->
                    <div class="pb-2 pt-2 ml-5 d-sm-inline-block"> 
                      <form action="{{route('user.search')}}">
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

                <div class="container border p-0 table-responsive">
                  <table class="table table-sm table-hover text-nowrap table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Tài khoản</th>
                      <th>Email</th>
                      <th>Phân quyền</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    @foreach($user as $key=> $u)
                    <tr>
                      <td>{{($user->currentPage()-1)*$user->perPage()+$key+1}}</td>
                      <td>{{$u->tai_khoan}}</td>
                       <td>{{$u->email}}</td>
                      <td>{!!($u->phan_quyen==0)?'admin':'nhân viên';!!}</td>
                      <td>
                        @if(session()->get('user')->id!=$u->id)
                          <a href="{{route('user.viewupdate',['id'=>$u->id])}}" class="btn btn-sm" title="Chỉnh sửa">
                          <i class="far fa-edit" ></i> 
                          </a> 
                          <a href="{{route('user.delete',['id'=>$u->id])}}" class="btn btn-sm" title="Xóa bỏ" onclick="return confirm('Bạn có chắc muốn xóa bản ghi này ?')"">
                          <i class="fas fa-trash-alt" ></i>
                          </a>
                          @endif
                      </td>  
                    </tr>
                    @endforeach   
                  </tbody>
                </table>
                </div>
                
              </div>

              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  {{ $user->links() }}
                </ul> 
            </div>
              <!-- /.card-body -->
            </div>

          
            <!-- /.card -->
          </div>
        </div>
</div>
@endsection