@extends('layout.master')
@section('title', 'Category')
@section('content')
<!-- Products section -->
  <section id="aa-product">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="aa-product-area">
              <div class="aa-product-inner">
              <!-- start prduct navigation -->
                <ul class="nav nav-tabs aa-products-tab">
                  <li class="active"><a href="#cat1" data-toggle="tab">{{ $c->name }}</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                  <!-- Start category -->
                  <div class="tab-pane fade in active" id="cat1">
                    <ul class="aa-product-catg">
                      @foreach ($products as $product)
                      @if ($product->detail->statu != 3)
                      <li>
                        <figure>
                          <a class="aa-product-img" href="{{ route('category.product',[$c->slug, $product->slug]) }}"><img src="http://via.placeholder.com/250x300?text=Furkan" alt="polo shirt img"></a>
                          <form action="{{ route('cart.add') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <button style="width: 100%; border: 0px; outline: none;" class="aa-add-card-btn"><span class="fa fa-shopping-cart"></span>Add To Cart</button>
                          </form>
                          <figcaption>
                            <h4 class="aa-product-title"><a href="{{ route('category.product',[$c->slug, $product->slug]) }}">{{ $product->title }}</a></h4>
                            <span class="aa-product-price">${{ $product->price }}</span>
                            @if (!is_null($product->detail->old_price))
                              <span class="aa-product-price"><del>${{ $product->detail->old_price ?? null }}</del></span>
                            @endif
                          </figcaption>
                        </figure>                        
                        <!-- product badge -->
                        <span class="aa-badge aa-{{ $product->detail->statu == 1 ? 'sale' : 'hot' }}">{{ $product->detail->statu == 1 ? 'SALE!' : 'HOT!' }}</span>
                      </li>
                      @endif
                      @endforeach
                    </ul>
                  </div>
                  <!-- End category -->
                </div>           
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- / Products section -->
@endsection