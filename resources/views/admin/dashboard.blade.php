@extends('layoutadmin.master')

@section('content')
<div class="container">
<div class="container centered">
    <div class="col-lg-12 text-center">
        <h1 class="page-header">Trang Quản Trị</h1>
    </div>
</div>
    <!-- /.row -->
    <div class="row panel-container">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">26</div>
                            <div>Người Dùng Mới!</div>
                        </div>
                    </div>
                </div>
                <a href="userlist">
                    <div class="panel-footer">
                        <span class="pull-left">Xem Chi Tiết</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>s
                        <div class="col-xs-9 text-right">
                            <div class="huge">12</div>
                            <div>Đơn Hàng Mới!</div>
                        </div>
                    </div>
                </div>
                <a href="productlist">
                    <div class="panel-footer">
                        <span class="pull-left">Xem Chi Tiết</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <!-- Thêm các panel khác tương tự ở đây -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
@endsection
