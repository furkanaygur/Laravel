@extends('layout.master')
@section('title', 'Furkan Aygur')
@section('content')

  @include('layout.partials.alert')

  <!-- Start slider -->
  <section id="aa-slider">
    <div class="aa-slider-area">
      <div id="sequence" class="seq">
        <div class="seq-screen">
          <ul class="seq-canvas">
            
            @foreach ($setting['category'] as $category )
              <!-- single slide item -->
              <li>
                <div class="seq-model">
                  <img data-seq src="/img/1920x800.png" />
                </div>
                <div class="seq-title">
                <span data-seq>Save Up to 75% Off</span>                
                  <h2 data-seq>{{ $category->name }}</h2>                
                  <p data-seq>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus, illum.</p>
                  <a data-seq href="{{ route('category', $category->slug) }}" class="aa-shop-now-btn aa-secondary-btn">SHOP NOW</a>
                </div>
              </li>
            @endforeach
          </ul>
        </div>
        <!-- slider navigation btn -->
        <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
          <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
          <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
        </fieldset>
      </div>
    </div>
  </section>
  <!-- / slider -->
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
                  <li class="active"><a href="#products" data-toggle="tab">Products</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                  <div class="tab-pane fade in active" id="products">
                    <ul class="aa-product-catg">
                      <!-- start single product item -->
                      @foreach ($products as $product )
                        <li>
                          <figure>
                            <a class="aa-product-img" href="{{ route('category.product',[$product->categories[0]->slug, $product->slug]) }}"><img src="/img/250x300.png" alt=""></a>
                            <form action="{{ route('cart.add') }}" method="POST">
                              {{ csrf_field() }}
                              <input type="hidden" name="id" value="{{ $product->id }}">
                              <button style="width: 100%; border: 0px; outline: none;" class="aa-add-card-btn"><span class="fa fa-shopping-cart"></span>Add To Cart</button>
                            </form>
                              <figcaption>
                              <h4 class="aa-product-title"><a href="{{ route('category.product',[$product->categories[0]->slug, $product->slug]) }}">{{ $product->title }}</a></h4>
                              <span class="aa-product-price">${{ $product->price }}</span>
                              @if (!is_null(isset($product->detail->old_price)))
                                <span class="aa-product-price"><del>${{ $product->detail->old_price ?? null }}</del></span>
                              @endif
                            </figcaption>
                          </figure>                        
                          <!-- product badge -->
                          <span class="aa-badge aa-{{ $product->detail->statu == 1 ? 'sale' : 'hot' }}">{{ $product->detail->statu == 1 ? 'SALE!' : 'HOT!' }}</span>
                        </li>
                      @endforeach          
                    </ul>
                  </div>
                </div>       
              </div>
            </div>
          </div>
        </div>
      </div>
      {{ $products->links('pagination-links') }}    
    </div>
  </section>
  <!-- / Products section -->
  <!-- banner section -->
  <section style="margin-bottom: 4rem" id="aa-banner">
    <div class="container">
      <div class="row">
        <div class="col-md-12">        
          <div class="row">
            <div class="aa-banner-area">
            <a href="#"><img src="/img/1170x170.png" alt="fashion banner img"></a>
          </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Support section -->
  <section id="aa-support">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-support-area">
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-truck"></span>
                <h4>FREE SHIPPING</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-clock-o"></span>
                <h4>30 DAYS MONEY BACK</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-phone"></span>
                <h4>SUPPORT 24/7</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Support section -->
  <!-- Testimonial -->
  <section id="aa-testimonial">  
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-testimonial-area">
            <ul class="aa-testimonial-slider">
              <!-- single slide -->
              <li>
                <div class="aa-testimonial-single">
                <img class="aa-testimonial-img" src="/img/150x150.png" alt="testimonial img">
                  <span class="fa fa-quote-left aa-testimonial-quote"></span>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui!consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui.</p>
                  <div class="aa-testimonial-info">
                    <p>FURKAN</p>
                    <span>Designer</span>
                    <a href="#">Dribble.com</a>
                  </div>
                </div>
              </li>
              <!-- single slide -->
              <li>
                <div class="aa-testimonial-single">
                <img class="aa-testimonial-img" src="/img/150x150.png" alt="testimonial img">
                  <span class="fa fa-quote-left aa-testimonial-quote"></span>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui!consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui.</p>
                  <div class="aa-testimonial-info">
                    <p>FURKAN</p>
                    <span>CEO</span>
                    <a href="#">Alphabet</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Testimonial -->

@endsection
