<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>VNSoft Manager</title>
  <link rel="icon" href="dist/img/AdminLTELogo.png" class="brand-image img-circle elevation-3" style="opacity: .8">
  <base href="{{asset('')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
   <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <!-- datatable -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">


  @yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- time -->
      <li class="nav-item">
          <div class="nav-link" id="timenow"></div> 
      </li>
      <!-- user -->
      <li class="nav-item dropdown align-items-center">   
          <a class="nav-link " data-toggle="dropdown" href="#">
            <i class="far fa-user"></i>
            {{session()->get('user')->tai_khoan}}
          </a> 
       <div class="dropdown-menu dropdown-menu-sm">
          <a href="#" class="dropdown-item">  
            <div class="media">
              <div class="media-body">
                <h3 class="dropdown-item-title text-left">
                  Đổi mật khẩu
                </h3>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{route('logout')}}" class="dropdown-item">  
            <div class="media">
              <div class="media-body">
                <h3 class="dropdown-item-title text-left">
                  Đăng xuất
                </h3>
              </div>
            </div>
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <span class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light ">VNSoft 
Management</span>
    </span>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class=" mt-3 pb-3 mb-3 d-flex dropdown" >
        
      </div>
      <!-- dropdowd user -->
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item {{'/'==request()->path()?'active':''}}">
                <a href="{{route('phongban.index')}}" class="nav-link {{Request::is('phongban*')?'active':''}}">
                  <i class="fas fa-circle nav-icon"></i>
                  <p>Phòng Ban</p>
                </a>
          </li>
          <!-- phòng ban -->
          <li class="nav-item">
            <a href="{{route('chucvu.index')}}" class="nav-link {{Request::is('chucvu*')?'active':''}}">
              <i class="fas fa-circle nav-icon"></i>
              <p>Chức Vụ</p>
            </a>
          </li>
          <!-- chức vụ -->
          <li class="nav-item ">
            <a href="{{route('nhanvien.index')}}" class="nav-link {{Request::is('nhanvien*')?'active':''}}">
              <i class="fas fa-circle nav-icon"></i>
              <p>Nhân Viên</p>
            </a>
          </li>
          <!-- nhân viên -->
          <li class="nav-item {{Request::is('thuongphat*')?'menu-open':''}}">
            <a href="#" class="nav-link " >
              <i class="nav-icon fas fa-book"></i>
              <p>
                Thưởng/Phạt
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview ">
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thưởng</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('phat.index')}}" class="nav-link {{Request::is('*phat*')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Phạt </p>
                </a>
              </li>
            </ul>
          </li>
          <!-- thưởng/phạt -->
          <li class="nav-item {{Request::is('chamcong*')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Chấm Công
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('themmoi.index')}}" class="nav-link {{Request::is('chamcong/themmoi*')?'active':''}}" >
                      <i class="far fa-circle nav-icon"></i>
                      <p>Thêm Mới</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('lichsu.index')}}" class="nav-link {{Request::is('chamcong/lichsu*')?'active':''}}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Lịch Sử</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('nhapdulieu.index')}}" class="nav-link {{Request::is('chamcong/nhapdulieu*')?'active':''}}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Nhập file</p>
                    </a>
                  </li>
            </ul>
          </li>
          <!-- chấm công -->
          <li class="nav-item ">
            <a href="{{route('luong.index')}}" class="nav-link {{Request::is('luong*')?'active':''}} ">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Bảng Lương
              </p>
            </a>
            
          </li>
          <li class="nav-item ">
            <a href="{{route('user.index')}}" class="nav-link {{Request::is('user*')?'active':''}} ">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Tài khoản
              </p>
            </a>
            
          </li>
          <!-- bảng lương -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              @yield('breadcrumb')
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->

        @yield('content')
        <!-- /.row -->
        <!-- Main row -->
        
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>
<!-- datatable -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
@yield('js')
@include('sweetalert::alert')
<script>
    setInterval(() => {
        $("#timenow").html(moment().format("HH:mm:ss"));
    }, 1000);
</script>
</body>
</html>
