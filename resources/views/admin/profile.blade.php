@extends('layoutadmin.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thông Tin Người Dùng</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Thông Tin Cá Nhân
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label>Họ Tên:</label>
                        <p>{{ $user->full_name }}</p>
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <p>{{ $user->email }}</p>
                    </div>
                    <div class="form-group">
                        <label>Địa Chỉ:</label>
                        <p>{{ $user->address }}</p>
                    </div>
                    <div class="form-group">
                        <label>Số Điện Thoại:</label>
                        <p>{{ $user->phone }}</p>
                    </div>
                    <div class="form-group">
                        <a href="#" class="btn btn-primary">Chỉnh Sửa Thông Tin</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
