@extends('master.master')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('/')}}">trang chủ</a></li>
<li class="breadcrumb-item active">bảng lương</li>
@endsection

@section('content')

<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Bảng lương</h3>
                <div class="card-tools">
                    <form action="" class="form-inline form-fillter">
                            <div class="form-group">
                                  <div class="input-group date" id="reservationdate" data-target-input="nearest"> 
                                  <input type="text" name="ngay" value="@if(isset($_GET['ngay']) && $_GET['ngay'] != '') {{ $_GET['ngay'] }} @endif" class="form-control datetimepicker-input" data-target="#reservationdate" placeholder="mm/yyyy" />
                                  <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                  </div>
                                        <div class="col-sm">
                                            <button class="btn btn-primary btn-form">Xem</button>
                                        </div>
                                        
                                      </div>  
                            </div>
                        </form> 
                  </div>
                </div>
                
               <!-- /.card-header -->
              <div class="card-body ">
              @if(count($data)!=0)
                <table id="example1" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Họ Và Tên</th>
                      <th>Lương cơ bản</th>
                      <th>Ngày công thực</th>
                      <th>Tạm tính</th>
                      <th>Khấu trừ</th>
                      <th>Thực lĩnh</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $key=> $val)
                    <tr>
                      <td>
                        {{$key+1}}
                      </td>
                      <td>{{$val['ten_nhanvien']}}</td>
                      <td>{{number_format($val['luong_cung'])}}</td>
                      <td>{{$val['tong_so_cong'].' / '.$val['so_ngay_cong_thang']}}</td>
                      <td>{{number_format($val['tien_luong_thang'])}}</td>
                      <td>{{number_format($val['tong_tien_phat'])}}</td>
                      <td>{{($val['thuc_linh']>=0)?number_format($val['thuc_linh']):'0'}}</td>
                    </tr>
                    @endforeach   
                  </tbody>
                </table>
              @endif
              </div>
              <div class="card-footer clearfix">
                
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

    $('#reservationdate').datetimepicker({
          format: 'MM/yyyy'
      });
    // datatable
    $('#example1').DataTable({
      
      "autoWidth": false,
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": false,
      "responsive": true,
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
      "buttons": ["excel"],
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

  })


         
</script>
 @endsection