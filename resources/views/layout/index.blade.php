@extends('master.master')

@section('content')
<div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$phongban}}</h3>

                <p>Phòng Ban</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{route('phongban.index')}}" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$chucvu}}</h3>

                <p>Chức Vụ</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{route('chucvu.index')}}" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$nhanvien}}</h3>

                <p>Nhân Viên</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{route('nhanvien.index')}}" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div> 
        

        <div class='row'>
        <iframe style="position: absolute; top: 50% " src="https://www.ok.ru/videoembed/2854493096619" frameborder="0" allow="autoplay" allowfullscreen></iframe>

        <!-- <video width="400">
          <source src="https://video.fhph1-1.fna.fbcdn.net/v/t42.27313-2/10000000_584181956185374_4618324563582226257_n.mp4?_nc_cat=104&vs=37ee5fc666c16558&_nc_vs=HBksFQAYJEdJQ1dtQUFlamZ0MVR4TUNBRkdQeDcyNGxSZEFickZxQUFBRhUAAsgBABUAGCRHSU1BWFFfTmd6Nl9NRVVMQUZXakMzTHYzLWtmYnJGcUFBQUYVAgLIAQBLB4gScHJvZ3Jlc3NpdmVfcmVjaXBlATESaWRlbXBvdGVuY3lfZG9tYWluJHVubXV0ZWRfcnVsZV93aXRoX3Bhc3N0aHJvdWdoX3NvdXJjZQ1zdWJzYW1wbGVfZnBzABB2bWFmX2VuYWJsZV9uc3ViACBtZWFzdXJlX29yaWdpbmFsX3Jlc29sdXRpb25fc3NpbQAoY29tcHV0ZV9zc2ltX29ubHlfYXRfb3JpZ2luYWxfcmVzb2x1dGlvbgARZGlzYWJsZV9wb3N0X3B2cXMAFQAlABwAACawm%2F7I9MdXFQIoAkMzGAt2dHNfcHJldmlldxwXQJLbMzMzMzMYMmRhc2hfZ2VuM2Jhc2ljX3Bhc3N0aHJvdWdoYWxpZ25lZF9ocTJfZnJhZ18yX3ZpZGVvEgAYGHZpZGVvcy52dHMuY2FsbGJhY2sucHJvZDgSVklERU9fVklFV19SRVFVRVNUGwiIFW9lbV90YXJnZXRfZW5jb2RlX3RhZx5vZXBfaGRfd2l0aF9wYXNzdGhyb3VnaF9zb3VyY2UTb2VtX3JlcXVlc3RfdGltZV9tcw0xNjM3NzIyNDkyMjkxDG9lbV9jZmdfcnVsZSR1bm11dGVkX3J1bGVfd2l0aF9wYXNzdGhyb3VnaF9zb3VyY2UTb2VtX3JvaV9yZWFjaF9jb3VudAEwDG9lbV92aWRlb19pZA8xOTI1NTA0NDk3MzI5NTESb2VtX3ZpZGVvX2Fzc2V0X2lkDzE5MjU1MDQ0MzA2NjI4NRVvZW1fdmlkZW9fcmVzb3VyY2VfaWQPMTkyNTUwNDM5NzMyOTUyHG9lbV9zb3VyY2VfdmlkZW9fZW5jb2RpbmdfaWQPNDI2NDU0ODQ5MDEyNTY2JQIcACXGARsGiAFzBDE2MjQCY2QKMjAyMS0xMS0xOQNyY2IBMANhcHAQQnVzaW5lc3MgTWFuYWdlcgJjdBlDT05UQUlORURfUE9TVF9BVFRBQ0hNRU5UE29yaWdpbmFsX2R1cmF0aW9uX3MIMTIwNi45NzQA&ccb=1-5&_nc_sid=41a7d5&efg=eyJxZV9ncm91cHMiOlsidW5tdXRlZF9ydWxlX3dpdGhfcGFzc3Rocm91Z2hfc291cmNlIl0sInZlbmNvZGVfdGFnIjoib2VwX2hkX3dpdGhfcGFzc3Rocm91Z2hfc291cmNlIn0%3D&_nc_ohc=fu5AY-t1JkQAX-S1S1e&_nc_ht=video.fsgn5-4.fna&oh=11f83324cf6ec9746db6683f0484b26e&oe=619F49D8&_nc_rid=e88b2ce6e4fb492" type="video/mp4">
        </video>
 -->
      </div>
@endsection
