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
                        <!-- start single product item -->
                        <li>
                          <figure>
                            <a class="aa-product-img" href="#"><img src="http://via.placeholder.com/250x300?text=Furkan" alt="polo shirt img"></a>
                            <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                              <figcaption>
                              <h4 class="aa-product-title"><a href="#">{{ $product->title }}</a></h4>
                              <span class="aa-product-price">${{ $product->price }}</span><span class="aa-product-price"><del>${{ $product->price + 5 }}</del></span>
                            </figcaption>
                          </figure>                        
                          <!-- product badge -->
                          <span class="aa-badge aa-sale" href="#">SALE!</span>
                        </li>
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