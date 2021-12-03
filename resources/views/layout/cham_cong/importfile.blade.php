@extends('master.master')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('/')}}">trang chủ</a></li>
<li class="breadcrumb-item">nhập dữ liệu</li>
@endsection
<?php function EmployeesID($id_database) {
						$len = strlen($id_database);
					    for($i=$len; $i< 4; ++$i) {
					        $id_database = '0'.$id_database;
					    }
					    return 'NV'.$id_database;
					}
?>
@section('css')
<style> 
.hidden{
  display: none;
}
</style>
@endsection
@section('content')
<div class="row ">
	<div class="col-12"> 
    <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Nhập dữ liệu chấm công</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
          </div>
          <div class="card-body">
            <form class="form" action="{{route('nhapdulieu.index')}}" enctype="multipart/form-data" method="POST">
              @csrf
              <div class="form-row">
                <div class="form-group">
                    <label>Nhập file Exel<span class="text-danger">*</span></label>
                    <input type="file" class="form-control-file " name="file_cham_cong">
                </div>
              </div>
              @if ($errors->has('file_cham_cong'))
                  <p class="text-danger small">{{ $errors->first('file_cham_cong') }}</p>
                @endif
              <button class="btn btn-primary" type="submit">
                    <span class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
                    Nhập
              </button>
            </form>
          </div>
    </div>
  </div>
</div>

@endsection
@section('js')
<script>
  $(document).ready(function(){

      $('.btn').click(function(){
          $('.spinner-border').removeClass('hidden');
          $('.btn').attr('disabled',true);
          $('.form').submit();
      });
  });
</script>
@endsection
        


