@extends('master.master')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('/')}}">trang chủ</a></li>
<li class="breadcrumb-item active">lịch sử chấm công</li>
@endsection

@section('content')

<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Lịch sử chấm công</h3>
                <div class="card-tools">
                		<form action="" class="form-inline form-fillter">
                            <div class="form-group">

                                       <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                       	<div class="col-sm">
                                        		<select name="phongban" class="form-control"  id="phongban">
                                        			<option value="0">Chọn Phòng Ban</option>
                                        			@foreach($phongban as $key=> $pb)
                                        			<option @if(isset($_GET['phongban'])&&($_GET['phongban']==$pb->id_phongban)) selected @endif value="{{$pb->id_phongban}}">{{$pb->ten_phong}}</option>
                                        			@endforeach
                                        		</select>
                                    		</div>
                                       		<div class="col-sm">
                                        		<select class="form-control" name="nhanvien" id="nhanvien">
                                        			<option value="">Chọn Nhân Viên</option>
                                        			@foreach($nhanvien as $nv)
                                        			<option @if(isset($_GET['nhanvien'])&&($_GET['nhanvien']==$nv->id_nhanvien)) selected @endif value="{{$nv->id_nhanvien}}">{{$nv->ten_nhanvien}}</option>
                                        			@endforeach
                                        		</select>
                                    		</div>
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
                <div class="container p-0 table-responsive">
                     @if(isset($data) && count($data)> 0)
                <table id="example1" class="table table-sm table-hover table-bordered">
                  <thead>
                    <tr>
                      <th>Thứ</th>
                      <th>Ngày</th>
                      <th>Giờ đến</th>
                      <th>Giờ về</th>
                      <th>Tính công</th>
                      <th>Muộn (phút)</th>
                      <th>Về sớm (phút)</th>
                      <th>Phạt (vnđ)</th> 
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $key=>$value)
                    <tr class="@if($value['ten_ngay']=='Chủ nhật'){{ 'bg-secondary' }}@endif @if(date('Y-m-d', strtotime(now()))==$value['ngay_cham']){{ 'table-success' }}@endif ">
                      <th>{{$value['ten_ngay']}}</th>
                      <td >{{$key}}</td>
                      <td>{{ ($value['gio_den'] === NULL) ? '' : date('H:i',strtotime($value['gio_den'])) }}</td>
                      <td>{{ ($value['gio_ve'] === NULL) ? '' : date('H:i',strtotime($value['gio_ve'])) }}</td> 
                      <td>{{$value['so_cong']}}</td>
                      <td>{{$value['so_phut_di_muon']}}</td>
                      <td>{{$value['so_phut_ve_som']}}</td>
                      <td>{{number_format($value['bi_phat'])}}</td>
                      <td>
                        @if($value['ten_ngay']!='Chủ nhật'&&strtotime($value['ngay_cham']) < strtotime(now()))
                        <a data-toggle="modal" 

                        data-start='<?php if($value['gio_den'] === NULL){echo '08:30';}else{echo date('H:i',strtotime($value['gio_den']));} ?>'
                        data-end='<?php if($value['gio_ve'] === NULL){echo '17:30';}else{echo date('H:i',strtotime($value['gio_ve']));} ?>'
                        data-date='{{$value['ngay_cham']}}'
                        data-id='{{$value['id']}}'
                                    class="btn btn-sm btn-modal" title="Chỉnh sửa">
                          <i class="far fa-edit" ></i> 
                          </a>
                        @endif
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
              </table>
              @endif
                </div>
               
          </div>
              <div class="card-footer clearfix">
                
            </div>
              <!-- /.card-body -->
            </div>
          
            <!-- /.card -->
          </div>
        </div>


        <!-- modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title title-modal "  id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form action="{{route('lichsu.update')}}" method="GET">
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Giờ đến:</label>
                <input type="time" name="time_start" class="form-control time-start">
                <input type="hidden" name="id" class="form-control id">
                <input type="hidden" name="id_nhanvien" <?php if(isset($_GET['nhanvien'])){echo 'value="'.$_GET['nhanvien'].'"';}?> class="form-control">
              </div>
              <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Giờ về:</label>
                  <input type="time" name="time_end" class="form-control time-end">
                  <input type="hidden" name="date" class="form-control date">
              </div>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="submit" class="btn btn-primary">Lưu</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
 	$(document).ready(function(){

 		$('#reservationdate').datetimepicker({
        	format: 'MM/yyyy'
    	});

    	// $('#phongban').change(function(event) {
    	// 	var id=$(this).val();
    	// 	if(id!=0){
    	// 		$.ajax({
    	// 			type:'get',
    	// 			cache:'false',
    	// 			url: '{{route('getIdPhongBan')}}',
    	// 			data: {
    	// 				"id_phong":id
    	// 			},
    	// 			success:function(data) {
    	// 				$('#nhanvien').html(data)
    	// 			},
    	// 		})
    			
    			
    	// 	}
    	// });
    	$('#phongban').change(function(event){
    		$('.form-fillter').submit()
    	})
      $('#phongban').click(function(event){
        $('.btn-form').submit()
      })
      $('#example1').DataTable({
      
      "autoWidth": true,
      "paging": false,
      "lengthChange": false,
      "searching": false,
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
      "buttons": ["excel","pdf"],
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


    $('.btn-modal').click(function(){
      $('.title-modal').html('Cập nhật '+$(this).data('date'));
      $('.time-start').val($(this).data('start'));
      $('.time-end').val($(this).data('end'));
      $('.id').val($(this).data('id'));
      $('.date').val($(this).data('date'));
      $('#exampleModal').modal('show');

    })  

 
 	})
         
</script>
 @endsection