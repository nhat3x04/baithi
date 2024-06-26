<!doctype html>
<html lang="en">
  <head>
    <title>Thêm trái cây mới</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <h2 class="my-4">Tạo trái cây</h2>
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="name">name:</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name">
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="unit_price">unit_price:</label>
                <input type="number" class="form-control @error('unit_price') is-invalid @enderror" id="unit_price" name="unit_price">
                @error('unit_price')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="promotion_price">promotion_price:</label>
                <input type="number" class="form-control @error('promotion_price') is-invalid @enderror" id="promotion_price" name="promotion_price">
                @error('promotion_price')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control @error('image_file') is-invalid @enderror" id="image_file" name="image_file" onchange="previewImage(event)">
                @error('image_file')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <img id="imagePreview" src="#" alt="Image Preview" class="img-fluid mt-2" style="display: none;">
            </div>
            
            <div class="form-group">
                <label for="description">description:</label>
                <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description">
                @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
    
          
            <div class="form-group">
                <label for="new">new: </label>
                <select class="form-control @error('new') is-invalid @enderror" name="new" id="new">
                  <option value="1">1</option>
                  <option value="0">0</option>
                </select>
                @error('new')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="unit">unit:</label>
                <select class="form-control @error('unit') is-invalid @enderror" name="unit" id="unit">
                  <option value="hộp">hộp</option>
                  <option value="cái">cái</option>
                </select>
                @error('unit')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
    
            
            <button type="submit" class="btn btn-primary">Thêm</button>
<a href="{{ route('banhang.index-show') }}" class="btn btn-secondary">Quay lại danh sách</a>
        </form>
    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4xF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <script>
      function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
          var output = document.getElementById('imagePreview');
          output.src = reader.result;
          output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
      }
    </script>
  </body>
</html>