@extends('layout.master')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Kết quả tìm kiếm cho "{{ $query }}"</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-12">
                @if($products->isEmpty())
                    <p>Không tìm thấy sản phẩm nào.</p>
                @else
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Giá gốc</th>
                                <th>Giá khuyến mãi</th>
                                <th>Mô tả</th>
                                <th>Đơn vị</th>
                                <th>Hàng mới</th>
                                <th>Hình ảnh</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr class="odd gradeX" align="center">
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->unit_price }}</td>
                                    <td>{{ $product->promotion_price }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->unit }}</td>
                                    <td>{{ $product->new }}</td>
                                    <td><img src="/source/image/product/{{ $product->image }}" alt="" width="80px" height="80px"></td>
                                    <td>
                                        <a href="{{ route('products.edit', ['id' => $product->id]) }}" class="btn btn-warning">Sửa</a>
                                        <form action="{{ route('products.destroy', ['id' => $product->id]) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection
