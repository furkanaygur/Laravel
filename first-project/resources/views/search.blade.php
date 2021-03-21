@extends('layout.master')
@section('title','Search')
@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ route('index') }}">Anasayfa</a></li>
            <li class="active">Arama Sonucu</li>
        </ol>
        <div class="products bg-content">
            <div class="row">
                @foreach ($products as $product )
                    <div class="col-md-3 product">
                        <a href="{{ route('product', $product->slug) }}">
                            <img src="http://via.placeholder.com/400x400?text=ProductPic">
                        </a>
                        <p>
                            <a href="{{ route('product',$product->slug) }}">
                                {{ $product->product_name }}
                            </a>
                            <p class="price">{{ $product->price }}</p>
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
        {{ $products->appends(['search_key' => old('search_key')])->links() }}
    </div>
@endsection