@extends('master.master')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('/')}}">trang chủ</a></li>
<li class="breadcrumb-item"><a href="{{route('phongban.index')}}">phòng ban</a></li>
<li class="breadcrumb-item">cập nhật</li>
@endsection

@section('content')
<div class="row">
	<div class="col-12"> 
	<div class="card card-default">
	          <div class="card-header">
	            <h3 class="card-title">Cập nhật phòng ban</h3>

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
	          		<form action="{{route('phongban.update')}}" method="POST">
	          			 @csrf
	          			 <div class="form-group">
	                    <label for="exampleInputEmail1">Tên Phòng Ban<span class="text-danger">*</span></label>
	                    <input type="hidden" name="id_phong" value="{{$phongban->id_phongban}}">
	                    <input type="text" class="form-control @if ($errors->has('ten_phongban')) is-invalid @endif" value="{{$phongban->ten_phong}}" name="ten_phongban" id="name" placeholder="Nhập tên phòng ban">
	                    @if ($errors->has('ten_phongban'))
									        <p class="text-danger small">{{ $errors->first('ten_phongban') }}</p>
									    @endif
		                </div>
		                 <div class="form-group">
												<label for="exampleFormControlTextarea1">Mô Tả</label id>
												<textarea id="" name="mo_ta" rows="4" class="form-control" >{{$phongban->mo_ta}}</textarea>
											</div>
									<button class="btn btn-primary" type="submit">Cập nhật</button>
	          		</form>
	           	</div>
          <!-- /.card-body -->
          <div class="card-footer">
          </div>
        </div>
@endsection


