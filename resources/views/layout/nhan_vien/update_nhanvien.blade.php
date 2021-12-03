@extends('master.master')
<?php function EmployeesID($id_database) {
						$len = strlen($id_database);
					    for($i=$len; $i< 4; ++$i) {
					        $id_database = '0'.$id_database;
					    }
					    return $id_database;
					}
?>
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('/')}}">trang chủ</a></li>
<li class="breadcrumb-item"><a href="{{route('nhanvien.index')}}">nhân viên</a></li>
<li class="breadcrumb-item">cập nhật</li>
@endsection

@section('content')
<div class="row">
	<div class="col-12"> 
	<div class="card card-default">
	          <div class="card-header">
	            <h3 class="card-title">Cập nhật nhân viên <b>{{'NV'.EmployeesID($nhanvien->id_nhanvien)}}</b></h3>

	            <div class="card-tools">
	              <button type="button" class="btn btn-tool" data-card-widget="collapse">
	                <i class="fas fa-minus"></i>
	              </button>
	              <button type="button" class="btn btn-tool" data-card-widget="remove">
	                <i class="fas fa-times"></i>
	              </button>
	            </div>
	          </div>
	          <!-- /.card-header -->
	          	<div class="card-body">

	          		<form action="{{route('nhanvien.update')}}" method="POST" enctype="multipart/form-data">
	          			 @csrf
	          		<div class="form-row">
	          			<div class="col-6">
	          				
	          				<div class="form-group">
		                    <label>Họ và Tên<span class="text-danger">*</span></label>
		                    <input type="text" class="form-control" name="ten_nhanvien" value="{{$nhanvien->ten_nhanvien}}" placeholder="Nhập tên nhân viên">
		                    <input type="hidden" class="form-control @if($errors->has('ten_nhanvien')) is-invalid @endif" name="id_nhanvien" value="{{$nhanvien->id_nhanvien}}" placeholder="Nhập tên nhân viên">
		                    @if ($errors->has('ten_nhanvien'))
									        <p class="text-danger small">{{ $errors->first('ten_nhanvien') }}</p>
									    		@endif
		                </div>
		                 
		                 <div class="form-group">
		                    <label>Ngày sinh<span class="text-danger">*</span></label>
		                    <input type="date" class="form-control @if ($errors->has('ngay_sinh')) is-invalid @endif" name="ngay_sinh" value="{{$nhanvien->ngay_sinh}}" placeholder="Nhập tên nhân viên">
		                    @if ($errors->has('ngay_sinh'))
									        <p class="text-danger small">{{ $errors->first('ngay_sinh') }}</p>
									    		@endif
		                </div>
		                 <div class="form-group">
		                    <label>Quê quán<span class="text-danger">*</span></label>
		                    <input type="text" class="form-control @if ($errors->has('que_quan')) is-invalid @endif" name="que_quan" value="{{$nhanvien->que_quan}}" placeholder="Nhập quê quán">
		                    @if ($errors->has('que_quan'))
									        <p class="text-danger small">{{ $errors->first('que_quan') }}</p>
									    		@endif
		                </div>
		                <div class="form-group">
			                    <label>Số điện thoại<span class="text-danger">*</span></label>
			                    <input type="text" class="form-control @if ($errors->has('sdt')) is-invalid @endif" name="sdt" value="{{$nhanvien->sdt}}" placeholder="Nhập số điện thoại">
			                    @if ($errors->has('sdt'))
									        <p class="text-danger small">{{ $errors->first('sdt') }}</p>
									    		@endif
			                </div>
			                <div class="form-group">
		                 	<label class="form-inline">Giới tính<span class="text-danger">*</span></label>
		                 	<div class="form-check form-check-inline">    
			                    <input type="radio" <?php if($nhanvien->gioi_tinh==1){ echo "checked=''";} ?> class="form-check-input"  value="1" name="gioi_tinh"  placeholder="Nhập tên nhân viên">
			                    <label class="form-check-label">Nam</label>
		                	</div>
		                	<div class="form-check form-check-inline">
			                    <input <?php if($nhanvien->gioi_tinh==0){ echo "checked=''";} ?>  type="radio" class="form-check-input" value="0" name="gioi_tinh" placeholder="Nhập tên nhân viên">	
			                    <label class="form-check-label">Nữ</label>
		                	</div>
		                	@if ($errors->has('gioi_tinh'))
									        <p class="text-danger small">{{ $errors->first('gioi_tinh') }}</p>
									    		@endif
		                 </div>
			                <div class="form-group">
		                    <label>Ảnh 2X3</label>
		                    <input type="file" class="form-control-file" name="anh_the" placeholder="Nhập tên nhân viên">
		                    @if ($errors->has('anh_the'))
									        <p class="text-danger small">{{ $errors->first('anh_the') }}</p>
									    		@endif
		                </div>
	          			</div>
	          			<!--  -->
	          			<div class="col-6">
	          				
			                 <div class="form-group">
			                    <label>Email<span class="text-danger">*</span></label>
			                    <input type="email" class="form-control @if ($errors->has('email')) is-invalid @endif" name="email" value="{{$nhanvien->email}}" placeholder="Nhập email">
			                </div>
			                 <div class="form-group">
			                    <label>Phòng ban<span class="text-danger">*</span></label>
			                   <select name="phong_ban" class="form-control" >
										      @foreach($phongban as $pb)
										      <option <?php if($pb->id_phongban==$nhanvien->phong_ban){echo "selected";} ?> value="{{$pb->id_phongban}}">{{$pb->ten_phong}}</option>
										      @endforeach
										    </select>
										    @if ($errors->has('phong_ban'))
									        <p class="text-danger small">{{ $errors->first('phong_ban') }}</p>
									    		@endif
			                </div>
			                 <div class="form-group">
			                    <label>Chức vụ<span class="text-danger">*</span></label>
			                     <select name="chuc_vu" class="form-control" >
							      
							      @foreach($chucvu as $cv)
							      <option <?php if($cv->id_chucvu==$nhanvien->chuc_vu){echo "selected";} ?> value="{{$cv->id_chucvu}}">{{$cv->ten_chucvu}}</option>
							      @endforeach
							    </select>
			                </div>
			                 <div class="form-group">
			                    <label>Lương cơ bản<span class="text-danger">*</span></label>
			                    <input data-type='currency' type="text" class="form-control @if ($errors->has('luong_cung')) is-invalid @endif" name="luong_cung" value="{{number_format($nhanvien->luong_cung)}}" placeholder="Nhập mức lương cứng">
			                    @if ($errors->has('luong_cung'))
									        <p class="text-danger small">{{ $errors->first('luong_cung') }}</p>
									    		@endif
			                </div>
			               
	          			</div>
	          		</div>
	          		
	          			
		                 
						<button class="btn btn-primary" type="submit">Cập nhật</button>
	          		</form>
	           	</div>
	           
	</div>
	                <!-- /.form-group -->
	</div>
	              <!-- /.col -->
</div>
          </div>
          <!-- /.card-body -->
         
        </div>
@endsection

@section('js')
<script type="text/javascript">
	$(document).ready(function(){
			$("input[data-type='currency']").on({
		    keyup: function() {
		      formatCurrency($(this));
		    },
		    blur: function() { 
		      formatCurrency($(this), "blur");
		    }
		});


		function formatNumber(n) {
		  // format number 1000000 to 1,234,567
		  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
		}


		function formatCurrency(input, blur) {
		  // appends $ to value, validates decimal side
		  // and puts cursor back in right position.
		  
		  // get input value
		  var input_val = input.val();
		  
		  // don't validate empty input
		  if (input_val === "") { return; }
		  
		  // original length
		  var original_len = input_val.length;

		  // initial caret position 
		  var caret_pos = input.prop("selectionStart");
		    
		  // check for decimal
		  if (input_val.indexOf(".") >= 0) {

		    // get position of first decimal
		    // this prevents multiple decimals from
		    // being entered
		    var decimal_pos = input_val.indexOf(".");

		    // split number by decimal point
		    var left_side = input_val.substring(0, decimal_pos);
		    var right_side = input_val.substring(decimal_pos);

		    // add commas to left side of number
		    left_side = formatNumber(left_side);

		    // validate right side
		    right_side = formatNumber(right_side);
		    
		    // On blur make sure 2 numbers after decimal
		    if (blur === "blur") {
		      right_side += "00";
		    }
		    
		    // Limit decimal to only 2 digits
		    right_side = right_side.substring(0, 2);

		    // join number by .
		    input_val =left_side + "." + right_side;

		  } else {
		    // no decimal entered
		    // add commas to number
		    // remove all non-digits
		    input_val = formatNumber(input_val);

		    // final formatting
		    
		  }
		  
		  // send updated string to input
		  input.val(input_val);

		  // put caret back in the right position
		  var updated_len = input_val.length;
		  caret_pos = updated_len - original_len + caret_pos;
		  input[0].setSelectionRange(caret_pos, caret_pos);
		}
});
</script>
@endsection

