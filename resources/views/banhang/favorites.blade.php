@extends('layout.master')

@section('content')
    <div class="container">
        <h1>Your Favorite Products</h1>
        <div class="row">
            @foreach ($favorites as $product)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img class="card-img-top" src="/source/image/product/{{$product->image}}" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">
                                @if($product->promotion_price > 0)
                                    <span class="text-danger">{{ number_format($product->promotion_price) }} đồng</span>
                                @else
                                    <span>{{ number_format($product->unit_price) }} đồng</span>
                                @endif
                            </p>
                            <a href="{{ route('detail.show', ['id' => $product->id]) }}" class="btn btn-primary">Detail</a>
                            <form action="{{ route('banhang.removeFromFavorites', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger">Bỏ yêu thích</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
