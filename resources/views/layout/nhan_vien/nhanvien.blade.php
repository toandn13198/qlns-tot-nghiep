@extends('master.master')

@section('css')
<style>
  .dataTables_filter {
     display: none;
}
</style>
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('/')}}">trang chủ</a></li>
<li class="breadcrumb-item active">nhân sự</li>
@endsection

@section('content')
<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Danh Sách Nhân Sự</h3>
              </div>
              <!-- /.card-header -->
              
                <div class="card-body">
                <div class="d-flex justify-content-between">
                  <div class="pb-2 pt-2 d-sm-inline-block">
                    <a class="btn btn-sm btn-primary" href="{{route('nhanvien.viewinsert')}}" title="Thêm Mới">
                      Thêm mới
                    </a>
                    </div>
                    <!-- right -->
                    <div class="pt-2 pb-2 ml-5 d-sm-inline-block"> 
                      <form action="{{route('nhanvien.search')}}">
                          <div class=" input-group input-group-sm">
                    <!-- search -->
                      <input  type="text"<?php if(isset($_GET['search'])){echo 'value="'.$_GET['search'].'"';}?> name="search" id='searchbox' class="form-control float-right" placeholder="Tìm nhân viên">
                    <div class="input-group-append"> 
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                      </form>
                    </div>
                    </div>
                  </div>
                </div>
                <div class="container p-0 table-responsive">
                  <table id="example1" class="table table-sm table-hover table-striped text-nowrap table-bordered dataTable">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Ảnh</th>
                      <th>Họ Và Tên</th>
                      <th>Giới tính</th>
                      <th>Ngày sinh</th>
                      <th>Quê quán</th>
                      <th>Số điện thoại</th>
                      <th>Email</th>
                      <th>Phòng ban</th>
                      <th>Chức vụ</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                   
                    @foreach($nhanvien as$key =>$nv)
                    <tr>
                      <td>{{($nhanvien->currentPage()-1)*$nhanvien->perPage()+$key+1}}</td>
                      <td><img style="width: 50px; height: 75px;" src="{{asset('image')}}/{{$nv->anh_the}}"></td>
                      <td>{{$nv->ten_nhanvien}}</td>
                      <td> @if($nv->gioi_tinh==1) Nam @else Nữ @endif </td>
                      <td>{{$nv->ngay_sinh}}</td>
                      <td>{{$nv->que_quan}}</td>
                      <td>{{$nv->sdt}}</td>
                      <td>{{$nv->email}}</td>
                      <td>
                        @foreach($phongban as $pb)
                          @if($pb->id_phongban==$nv->phong_ban)
                          {{$pb->ten_phong}}
                          @endif
                        @endforeach
                      </td>
                      <td>
                        @foreach($chucvu as $cv)
                          @if($cv->id_chucvu==$nv->chuc_vu)
                          {{$cv->ten_chucvu}}
                          @endif
                        @endforeach
                      </td>
                      <td>
                          <a href="{{route('nhanvien.viewupdate',['id_nhanvien'=>$nv->id_nhanvien])}}" class="btn btn-sm" title="Chỉnh sửa">
                          <i class="far fa-edit" ></i> 
                          </a>
                          <a href="{{route('nhanvien.delete',['id_nhanvien'=>$nv->id_nhanvien])}}" class="btn btn-sm" title="Xóa bỏ" onclick="return confirm(' Xóa nhân viên sẽ đồng thời xóa bỏ toàn bộ dữ liệu về chấm công, bảng lương đã có của nhân viên đó. Bạn có chắc muốn xóa bản ghi này ?')">
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
                  {{ $nhanvien->links() }}
                </ul> 
                
            </div>
              <!-- /.card-body -->
            </div>
          
            <!-- /.card -->
          </div>
        </div>
@endsection
@section('js')
<script type="text/javascript">
  $(document).ready(function(){

    // datatable
    $('#example1').DataTable({
      
      "autoWidth": false,
      "paging": false,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": false,
      "responsive": false,
      "language": 
      {
        search: "_INPUT_",
        searchPlaceholder: "Tìm kiếm...",
        "emptyTable": "Không có dữ liệu !",
        "paginate": {
          "previous": "Trước",
          "next":"Tiếp",
      },
    },
      "zeroRecords": "Không tìm thấy dữ liệu!",
  
    });
    // search
    var dbt = $('#example1').dataTable();
    $("#searchbox").keyup(function() {
        dbt.fnFilter(this.value);
    });   

})         
</script>
 @endsection