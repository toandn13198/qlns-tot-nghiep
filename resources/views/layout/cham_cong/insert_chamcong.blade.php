@extends('master.master')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('/')}}">trang chủ</a></li>
<li class="breadcrumb-item">chấm công mới</li>
@endsection
<?php function EmployeesID($id_database) {
						$len = strlen($id_database);
					    for($i=$len; $i< 4; ++$i) {
					        $id_database = '0'.$id_database;
					    }
					    return 'NV'.$id_database;
					}
?>
@section('content')
<div class="row">
	<div class="callout callout-info">
              Ngày chấm: {{session('ngay_cham')}} 
              <i title="Thay đổi" class="fas fa-pen-square" data-toggle="modal" data-target="#modal-sm"></i>
           
    </div>
</div>

<div class="row">
	<!-- left -->
	<div class="col-md-6">
		<div class="card card-danger">
          <div class="card-header">
                <h3 class="card-title">Đợi chấm công</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body ">
                <table id="tbl_doicham" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th >Mã NV</th>
                      <th>Họ và Tên</th>
                      <th>Chấm công</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@foreach($doicham as $dc)
                    <tr>
                      <td>{{EmployeesID($dc->id_nhanvien)}}</td>
                      <td>{{$dc->ten_nhanvien}}</td>
                      <td><button type="button" class="btn-xs btn-danger button-cham" data-name="{{$dc->ten_nhanvien}}" data-toggle="modal" data-vid="{{EmployeesID($dc->id_nhanvien)}}" data-id="{{$dc->id_nhanvien}}" data-img="{{asset('image')}}/{{$dc->anh_the}}"><i class="fas fa-plus-circle"></i></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
               
                </ul>
              </div>
    </div>
	</div>
	<!-- right -->
	<div class="col-md-6">
		<div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Đã chấm công</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body ">
                <table id="tbl_dacham" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th >Mã NV</th>
                      <th>Họ và Tên</th>
                      <th>Chấm công</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@foreach($dacham as $dac)
                    <tr>
                      <td>{{EmployeesID($dac->id_nhanvien)}}</td>
                      <td>{{$dac->ten_nhanvien}}</td></td>
                      <td><button type="button" class="btn-xs btn-success"><i class="fas fa-plus-circle"></i></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
	</div>
</div>
        <!-- modal lg-->
        <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modal_name"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('insertchamcong')}}">
              @csrf
            <div class="modal-body">
              <div class="row">
              	<div class="col-5">
              		<img id="modal_img" style="width: 100%;height:140px; margin-top: 10px;" alt="ảnh thẻ" >
              		<input type="hidden" id="modal_id" value="" name="id">
                  <div id="modal_vid" style="text-align: center;font-weight: bold;"></div>
              	</div>
              	<div class="col-7">
                  <div class="form-group">
                    <label class="form-group">Giờ đến</label>
                    <input class="form-control" id="modal_time" type="time" name="gio_den">
                  </div>
                  <div class="form-group">
                    <label class="form-group">Giờ về</label>
                    <input name="gio_ve" class="form-control" type="time" name="gio_ve">
                  </div>
                </div>   
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
              <button type="submit" id="btn-modal" class="btn btn-primary">Cập nhật</button>
            </div>
        	</form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal lg-->

<!-- modal small -->
      <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ngày Chấm</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div><form action="{{route('viewthemchamcong')}}">
            <div class="modal-body">
              <label>Chọn ngày:</label>
              <input type="date" value="{{session('ngay_cham')}}" name="date" class="form-control">
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
              <button type="submit" id="btn-modal" class="btn btn-primary">Cập nhật</button>
            </div>
        	</form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal small-->
@endsection

@section('js')
<script>
  //button-cham
	$(document).ready(function(){
  $('.button-cham').click(function(){
    var dt = new Date();
  var time = dt.getHours() + ":" + dt.getMinutes();
    $('#modal_time').val(time);
    $('#modal_name').text($(this).data('name'));
    $('#modal_id').val($(this).data('id'));
    $('#modal_img').attr("src",$(this).data('img'));
    $('#modal_vid').text($(this).data('vid'));
    $('#modal-lg').modal('show');
//  // $(this).replaceWith('<button type="button" class="btn-xs btn-success" data-toggle="modal" data-target="#modal-lg"><i class="fas fa-check-circle"></i></button>');
 });


// datatable
    $('#tbl_doicham').DataTable({
    
    "autoWidth": true,
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": false,
      "autoWidth": true,
      "responsive": true,
     	"language": {
        search: "_INPUT_",
        searchPlaceholder: "Tìm kiếm...",
        "emptyTable": "Không có dữ liệu !",
        "paginate": {
      		"previous": "Trước",
      		"next":"Tiếp",
    	},
    	"zeroRecords": "Không tìm thấy dữ liệu!",
    }
    })
     $('#tbl_dacham').DataTable({
    
    "autoWidth": true,
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": false,
      "autoWidth": true,
      "responsive": true,
     	"language": {
        search: "_INPUT_",
        searchPlaceholder: "Tìm kiếm...",
        "emptyTable": "Không có dữ liệu !",
        "paginate": {
      		"previous": "Trước",
      		"next":"Tiếp"
    	}
    }
    });
//end datatable





  });

 
</script>
@endsection

