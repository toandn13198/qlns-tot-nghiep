@extends('master.master')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('/')}}">trang chủ</a></li>
<li class="breadcrumb-item"><a href="{{route('user.index')}}">tài khoản</a></li>
<li class="breadcrumb-item">cập nhật</li>
@endsection

@section('content')
<div class="row">
	<div class="col-12"> 
	<div class="card card-default">
	          <div class="card-header">
	            <h3 class="card-title">Cập nhật tài khoản</h3>

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
	          		<form action="{{route('user.update')}}" method="POST">
	          			 @csrf
	          			 <div class="form-group">
	                    <label for="exampleInputEmail1">Tài khoản<span class="text-danger">*</span></label>
	                    <input type="text" class="form-control @if ($errors->has('tai_khoan')) is-invalid @endif" value="{{$user->tai_khoan}}" name="tai_khoan" id="name" placeholder="Nhập tên tài khoản">
	                    <input type="hidden" value="{{$user->id}}" name="id">
	                     @if ($errors->has('tai_khoan'))
									        <p class="text-danger small">{{ $errors->first('tai_khoan') }}</p>
									    @endif
		                </div>
		                <div class="form-group">
	                    <label for="exampleInputEmail1">Email<span class="text-danger">*</span></label>
	                    <input type="text" class="form-control @if ($errors->has('email')) is-invalid @endif" value="{{$user->email}}" name="email" id="name" placeholder="Nhập email">
	                     @if ($errors->has('email'))
									        <p class="text-danger small">{{ $errors->first('email') }}</p>
									    @endif
		                </div>
		                <div class="form-group">
	                    <label for="exampleInputEmail1">Phân quyền<span class="text-danger">*</span></label>
	                    <select name="phan_quyen" class="form-control @if($errors->has('phan_quyen')) is-invalid @endif " >
	                    	<option value="0" @if($user->phan_quyen==0) selected @endif >Admin</option>
	                    	<option value="1" @if($user->phan_quyen==1) selected @endif >Nhân viên</option>
	                    </select>
	                    @if($errors->has('phan_quyen'))
									        <p class="text-danger small">{{ $errors->first('phan_quyen') }}</p>
									    @endif
		                </div>
		                <div class="form-group">
	                    <label for="exampleInputEmail1">Mật khẩu</label>
	                    <input type="password" class="form-control @if ($errors->has('mat_khau')) is-invalid @endif" value="{{ old('mat_khau') }}" name="mat_khau" id="name" placeholder="Nhập mật khẩu">
	                     @if ($errors->has('mat_khau'))
									        <p class="text-danger small">{{ $errors->first('mat_khau') }}</p>
									    @endif
		                </div>
		                <div class="form-group">
	                    <label for="exampleInputEmail1">Nhập lại mật khẩu</label>
	                    <input type="password" class="form-control @if ($errors->has('re_mat_khau')) is-invalid @endif" value="{{ old('re_mat_khau') }}" name="re_mat_khau" id="name" placeholder="Nhập lại mật khẩu">
	                    @if ($errors->has('re_mat_khau'))
									        <p class="text-danger small">{{ $errors->first('re_mat_khau') }}</p>
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

