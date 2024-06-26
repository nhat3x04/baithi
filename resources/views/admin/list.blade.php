@extends('layoutadmin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Category
                    <small>List</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            @if (isset($products))
                @php
                    $products = $products;
                @endphp
            @endif  
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Unit Price</th>
                        <th>Promotion Price</th>
                        <th>Description</th>
                        <th>Unit</th>
                        <th>New</th>
                        <th>Image</th>
                        <th style="width:90px;">Actions</th>
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
                        <td>
                            <img src="/source/image/product/{{ $product->image }}" alt="" width="80px" height="80px">
                        </td>
                        <td class="center">
                            <a style="background-color:yellow; min-width:90px; border:1px black solid;" href="{{ route('products.edit', ['id' => $product->id]) }}">
                                <i class="fa fa-pencil fa-fw"></i> Edit
                            </a>
                            <form action="{{ route('products.destroy', ['id' => $product->id]) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background-color:red;min-width:50px;">
                                    <i class="fa fa-trash-o fa-fw"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $products->onEachSide(7)->links() }}
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection

<style>
    th, td {
        text-align: center;
    }
    th {
        width: 80px;
    }
    .fa {
        /* color: white */
    }
</style>
