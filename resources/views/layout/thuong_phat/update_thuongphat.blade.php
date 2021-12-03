@extends('master.master')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('/')}}">trang chủ</a></li>
<li class="breadcrumb-item"><a href="{{route('phat.index')}}">mức phạt</a></li>
<li class="breadcrumb-item">cập nhật</li>
@endsection

@section('content')
<div class="row">
	<div class="col-12"> 
	<div class="card card-default">
	          <div class="card-header">
	            <h3 class="card-title">Cập nhật thưởng phạt</h3>

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
	          		<form action="{{route('phat.update')}}" method="POST">
	          			 @csrf
	          			 <div class="form-group">
	                    <label for="exampleInputEmail1">Tên Mức Phạt</label>
	                    	<input type="text" class="form-control" name="ten_muc_phat" value="{{$thuongphat->ten_muc_phat}}" id="name" placeholder="Nhập tên mức phạt">
	                    	<input type="hidden" value="{{$thuongphat->id}}" name="id">
		                </div>
		                <div class="form-group">
	                    <label for="exampleInputEmail1">Từ (phút)</label>
	                    	<input type="number" class="form-control" value="{{$thuongphat->muon_tu}}" name="muon_tu" min="0" max="120" id="name" placeholder="Muộn từ">
		                </div>
		                <div class="form-group">
	                    <label for="exampleInputEmail1">Đến (phút)</label>
	                    	<input type="number" class="form-control" value="{{$thuongphat->den_muon}}" name="den_muon" min="0" max="120" id="name" placeholder="Đến muộn">
		                </div>
		                 <div class="form-group">
		                 	<label class="form-inline">Đơn vị tính</label>
		                 	<div class="form-check form-check-inline">    
			                    <input type="radio" @if($thuongphat->don_vi_tinh==0) checked @endif class="form-check-input don_vi_tinh" value="0" name="don_vi_tinh"  placeholder="Nhập tên nhân viên">
			                    <label class="form-check-label">VNĐ</label>
		                	</div>
		                	<div class="form-check form-check-inline">
			                    <input type="radio" @if($thuongphat->don_vi_tinh==1) checked @endif class="form-check-input don_vi_tinh" value="1" name="don_vi_tinh" placeholder="Nhập tên nhân viên">	
			                    <label class="form-check-label">Ngày công</label>
		                	</div>
		                 </div>
		                <div class="form-group">
	                    <label for="exampleInputEmail1">Mức Phạt</label>
	                    @if($thuongphat->don_vi_tinh==0)
	                    	<input id="number" type="text" data-type='currency' class="form-control"  name="muc_phat" value="{{$thuongphat->muc_phat}}"  placeholder="Nhập mức phạt">
	                    	@endif
	                    	@if($thuongphat->don_vi_tinh==1)
	                    	<input id="number" type="number" data-type='currency' class="form-control" min="0.5" max="1" step="0.5" name="muc_phat" value="{{$thuongphat->muc_phat}}"  placeholder="Nhập mức phạt">
	                    	@endif
		                </div>
							<button class="btn btn-primary" type="submit">Cập nhật</button>
	          		</form>
	           	</div>
          <!-- /.card-body -->
          <div class="card-footer">
          </div>
        </div>
@endsection
@section('js')
<script>
$(document).ready(function(){


	
		//input theo don vi tinh
		$('.don_vi_tinh').change(function(){
				let check=$(this).val();
				if(check==1){
					$('#number').removeData('data-type');
					$('#number').prop('type','number');
					$('#number').attr({'min':'0.5','max':'1','step':'0.5'});
				}else{
					$('#number').prop('type','text');
					$('#number').removeAttr('min','max','stateSaveParams');
					$('#number').attr('data-type','currency');
				}
		});
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




