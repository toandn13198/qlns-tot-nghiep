@extends('master.master')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('/')}}">trang chủ</a></li>
<li class="breadcrumb-item"><a href="{{route('nhanvien.index')}}">nhân viên</a></li>
<li class="breadcrumb-item">thêm mới</li>
@endsection

@section('content')
<div class="row">
	<div class="col-12"> 
	<div class="card card-default">
	          <div class="card-header">
	            <h3 class="card-title">Thêm mới nhân viên</h3>

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
	          		<form action="{{route('nhanvien.insert')}}" method="POST" enctype="multipart/form-data">
	          			 @csrf
	          		<div class="form-row">
	          			<div class="col-6">

	          				<div class="form-group">
		                    <label>Họ và Tên<span class="text-danger">*</span></label>
		                    <input type="text" value="{{old('ten_nhanvien')}}" class="form-control @if ($errors->has('ten_nhanvien')) is-invalid @endif" name="ten_nhanvien" id="name" placeholder="Nhập tên nhân viên">
		                    @if ($errors->has('ten_nhanvien'))
									        <p class="text-danger small">{{ $errors->first('ten_nhanvien') }}</p>
									    	@endif
		                </div>
		                 
		                 <div class="form-group">
		                    <label>Ngày sinh<span class="text-danger">*</span></label>
		                    <input type="date" value="{{old('ngay_sinh')}}" class="form-control @if ($errors->has('ngay_sinh')) is-invalid @endif" name="ngay_sinh" id="name" placeholder="Nhập tên nhân viên">
		                    @if ($errors->has('ngay_sinh'))
									        <p class="text-danger small">{{ $errors->first('ngay_sinh') }}</p>
									    	@endif

		                </div>
		                 <div class="form-group">
		                    <label>Quê quán<span class="text-danger">*</span></label>
		                    <input type="text" value="{{old('que_quan')}}" class="form-control @if ($errors->has('que_quan')) is-invalid @endif" name="que_quan" id="name" placeholder="Nhập quê quán">
		                    @if ($errors->has('que_quan'))
									        <p class="text-danger small">{{ $errors->first('que_quan') }}</p>
									    	@endif
		                </div>

		                <div class="form-group">
			                    <label>Số điện thoại<span class="text-danger">*</span></label>
			                    <input value="{{old('sdt')}}" type="text" class="form-control @if ($errors->has('sdt')) is-invalid @endif" name="sdt" id="name" placeholder="Nhập số điện thoại">
			                    @if ($errors->has('sdt'))
									        <p class="text-danger small">{{ $errors->first('sdt') }}</p>
									    	@endif
			                </div>

			                <div class="form-group">
			                 	<label class="form-inline">Giới tính<span class="text-danger">*</span></label>
			                 	<div class="form-check form-check-inline">    
				                    <input type="radio" checked="" class="form-check-input" value="1" name="gioi_tinh"  placeholder="Nhập tên nhân viên">
				                    <label class="form-check-label">Nam</label>
			                	</div>

			                	<div class="form-check form-check-inline">
				                    <input type="radio" @if(old('gioi_tinh')=='0') checked @endif class="form-check-input" value="0" name="gioi_tinh" placeholder="Nhập tên nhân viên">	
				                    <label class="form-check-label">Nữ</label>
			                	</div>
		                 </div>

			                <div class="form-group">
		                    <label>Ảnh 2X3</label>
		                    <input type="file" value="{{old('anh_the')}}" class="form-control-file " name="anh_the" placeholder="Nhập tên nhân viên">
		                    @if ($errors->has('anh_the'))
									        <p class="text-danger small">{{ $errors->first('anh_the') }}</p>
									    	@endif
		                </div>

	          			</div>
	          			<!-- RIGHT -->
	          			<div class="col-6">

			                 <div class="form-group">
			                    <label>Email<span class="text-danger">*</span></label>
			                    <input value="{{old('email')}}" type="email" class="form-control @if ($errors->has('email')) is-invalid @endif" name="email" id="name" placeholder="Nhập email">
			                    @if ($errors->has('email'))
									        <p class="text-danger small">{{ $errors->first('email') }}</p>
									    	@endif
			                </div>

			                 <div class="form-group">
			                    <label>Phòng ban<span class="text-danger">*</span></label>
				                  <select name="phong_ban" class="form-control @if ($errors->has('phong_ban')) is-invalid @endif" >
											      <option >--Phòng ban--</option>
											      @foreach($phongban as $pb)
											      <option value="{{$pb->id_phongban}}" @if(old('phong_ban')==$pb->id_phongban)? selected @endif>{{$pb->ten_phong}}</option>
											      @endforeach
											    </select>
								    			@if($errors->has('phong_ban'))
										        <p class="text-danger small">{{ $errors->first('phong_ban') }}</p>
										    	@endif
			                </div>

			                 <div class="form-group">
			                    <label>Chức vụ<span class="text-danger">*</span></label>
			                    <select name="chuc_vu" class="form-control @if ($errors->has('chuc_vu')) is-invalid @endif" >
											      <option >--Chức vụ--</option>
											      @foreach($chucvu as $cv)
											      <option  value="{{$cv->id_chucvu}}" @if(old('chuc_vu')==$cv->id_chucvu) selected @endif>{{$cv->ten_chucvu}}</option>
											      @endforeach
											    </select>
											    @if ($errors->has('chuc_vu'))
									        <p class="text-danger small">{{ $errors->first('chuc_vu') }}</p>
									    		@endif
			                </div>

			                 <div class="form-group">
			                    <label>Lương cơ bản<span class="text-danger">*</span></label>
			                    <input type="text" data-type='currency' class="form-control @if ($errors->has('luong_cung')) is-invalid @endif" value="{{old('luong_cung')}}" name="luong_cung" id="name" placeholder="Nhập mức lương cứng">
			                    @if ($errors->has('luong_cung'))
									        <p class="text-danger small">{{ $errors->first('luong_cung') }}</p>
									    		@endif
			                </div>
			                
	          			</div>
	          		</div>
								<button class="btn btn-primary" type="submit">Thêm mới</button>
	          		</form>
	           	</div>       
	</div>
	                <!-- /.form-group -->
	</div>
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

