@extends('layoutadmin.master')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Product
                    <small>Add</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Product Name</label>
                        <input class="form-control" name="name" placeholder="Please Enter Product Name" required />
                    </div>
                    <div class="form-group">
                        <label>Unit Price</label>
                        <input class="form-control" name="unit_price" placeholder="Please Enter Unit Price" required />
                    </div>
                    <div class="form-group">
                        <label>Promotion Price</label>
                        <input class="form-control" name="promotion_price" placeholder="Please Enter Promotion Price" />
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Unit</label>
                        <input class="form-control" name="unit" placeholder="Please Enter Unit" required />
                    </div>
                    <div class="form-group">
                        <label>New</label>
                        <input type="checkbox" name="new" value="1">
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control-file" name="image_file">
                    </div>
                    <div class="form-group">
                        <label>Type</label>
                        <select class="form-control" name="type" required>
                            <option value="" disabled selected>Please Select Type</option>
                            <option value="type1">Type 1</option>
                            <option value="type2">Type 2</option>
                            <option value="type3">Type 3</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                    <button type="submit" class="btn btn-default">Add Product</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection
