@extends('layout.master')
@section('title','index')
@section('content')  
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Kategoriler</div>
                    <div class="list-group categories">
                        @foreach ($categories as $category)
                            <a href="{{ route('category', $category->slug) }}" class="list-group-item"><i class="fa fa-arrow-circle-o-right"></i> {{$category->category_name}}</a> 
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @for ($i = 0; $i<count($product_slider);$i++)
                        <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : null }}"></li>
                        @endfor
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        @foreach ($product_slider as $index => $p)
                            <div class="item {{ $index == 1 ? 'active' : null }}">
                                <img src="http://via.placeholder.com/650x400?text=ProductPic" alt="...">
                                <div class="carousel-caption">
                                    <a href="{{ route('product',$p->slug) }}"> {{$p->product_name}}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default" id="sidebar-product">
                    <div class="panel-heading">Günün Fırsatı</div>
                    <div class="panel-body">
                        <a href="{{ route('product',$product_opportunity->slug) }}">
                            <img src="http://via.placeholder.com/400x400?text=ProductPic" class="img-responsive">
                        </a>
                        {{ $product_opportunity->product_name }} 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">Çok Satan Ürünler</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach ($product_best_seller as $p)
                            <div class="col-md-3 product">
                                <a href="{{ route('product', $p->slug) }}"><img src="http://via.placeholder.com/400x400?text=ProductPic"></a>
                                <p><a href="{{ route('product', $p->slug) }}">{{ $p->product_name }}</a></p>
                                <p class="price">{{ $p->price }} ₺</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">İndirimli Ürünler</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach ($product_discount as $p)
                            <div class="col-md-3 product">
                                <a href="{{ route('product', $p->slug) }}"><img src="http://via.placeholder.com/400x400?text=ProductPic"></a>
                                <p><a href="{{ route('product', $p->slug) }}">{{ $p->product_name }}</a></p>
                                <p class="price">{{ $p->price }} ₺</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection