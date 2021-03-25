@extends('layout.master')
@section('title',$category->category_name)
@section('content')
    <div class="container">
        <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">Anasayfa</a></li>
        <li class="active">{{ $category->category_name }}</li>
    </ol>
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $category->category_name }}</div>
                @if (count($subCategories) != 0)
                        <div class="panel-body">
                            <h3>Sub Categories</h3>
                            <div class="list-group categories">
                                @foreach ($subCategories as $category )
                                <a href="{{ route('category', $category->slug) }}" class="list-group-item"><i class="fa fa-arrow-circle-right"></i> {{ $category->category_name }}</a>
                                @endforeach
                            </div>  
                            {{-- <h3>Fiyat Aralığı</h3>
                            <form>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> 100-200
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> 200-300
                                        </label>
                                    </div>
                                </div>
                            </form> --}}
                        </div>
                @endif
            </div>
        </div>
        <div class="col-md-9">
            <div class="products bg-content">
                @if (count($products) != 0)
                        Sırala
                        <a href="?order=best_seller" class="btn btn-default">Çok Satanlar</a>
                        <a href="?order=new_products" class="btn btn-default">Yeni Ürünler</a>
                        <hr>          
                @endif
                
                <div class="row">
                    @if (count($products) != 0)
                    @foreach ($products as $product)
                            <div class="col-md-3 product">
                                <a href="{{ route('product', $product->slug) }}"><img class="thumbnail" src="{{ $product->detail->product_image != null ? asset('uploads/product/'. $product->detail->product_image) : 'http://via.placeholder.com/650x400?text=ProductPic' }}" alt="{{ $product->product_name }}"></a>
                                <p><a href="{{ route('product', $product->slug) }}">{{ $product->product_name }}</a></p>
                                <p class="price">{{ $product->price }} ₺</p>
                                <form action="{{ route('add_product') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <input type="submit" class="btn btn-theme" value="Sepete Ekle">
                                </form>
                            </div> 
                        @endforeach 
                        <div class="col-md-12">
                            {{ request()->has('order') ? $products->appends(['order'=> request('order')])->links() : $products->links() }}
                        </div>
                    @else
                        <div class="col-md-12"><div class="alert alert-info">There is no product</div></div>
                    @endif
                        
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection