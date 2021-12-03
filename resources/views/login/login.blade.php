<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<title>Quản Lý Nhân Sự</title>
  	<base href="{{asset('')}}">
  	<link rel="stylesheet" href="dist/css/adminlte.min.css">
  	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  	<link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
</head>
<body>
	 <section class="content mt-5">
      <div class="container p-5 d-sm-flex justify-content-center">
   				<div class="card card-info" style="width: 400px;">
              <div class="card-header">
                <h3 class="card-title">Đăng nhập</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form  action="{{route('login')}}" method="POST">
              	@csrf
                <div class="card-body">

                  <div class="form-group">
                    <label for="inputEmail3" class="col-form-label">Tài khoản</label>
                      <input type="text" class="form-control" name="tai_khoan" value="@if(Cookie::get('tai_khoan')) {{Cookie::get('tai_khoan')}}@endif"  placeholder="Nhập tên tài khoản">
                        @if ($errors->has('tai_khoan'))
                          <span class="text-danger small">{{ $errors->first('tai_khoan') }}</span>
                        @endif
                  </div>

                  <div class="form-group">
                    <label>Mật khẩu</label>
                      <input type="password" name="mat_khau" value="@if(Cookie::get('mat_khau')) {{Cookie::get('mat_khau')}}@endif" class="form-control" placeholder="Nhập mật khẩu">
                      @if ($errors->has('mat_khau'))
                          <span class="text-danger small">{{ $errors->first('mat_khau') }}</span>
                      @endif
                  </div>

                  <div class="form-group">
                      <div class="form-check">
                        <input type="checkbox" @if(Cookie::get('mat_khau')) checked @endif class="form-check-input" name="ghi_nho">
                        <label class="form-check-label" for="exampleCheck2">Nhớ tài khoản</label>
                      </div>
                  </div>
					  @if(session('noti'))
					  	<span class="text-success" >{{session('noti')}}</span>
					  @endif
            @if(session('err'))
              <span class="text-danger" >{{session('err')}}</span>
            @endif
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Đăng nhập</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
      </div>
  </section>
 <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
</body>
</html>