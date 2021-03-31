@extends('layout.master')
@section('title', config('app.name') . ' - ' .$product->title )
@section('content')
      <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
    <img src="http://via.placeholder.com/1920x300?text=Furkan" alt="fashion img">
    <div class="aa-catg-head-banner-area">
      <div class="container">
       <div class="aa-catg-head-banner-content">
         <h2>T-Shirt</h2>
         <ol class="breadcrumb">
           <li><a href="{{ route('user.index') }}">Home</a></li>         
           <li><a href="{{ route('category', $c->slug) }}">{{ $c->name }}</a></li>
           <li class="active">{{ $product->title }}</li>
         </ol>
       </div>
      </div>
    </div>
   </section>
   <!-- / catg header banner section -->

<!-- product category -->
  <section id="aa-product-details">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-product-details-area">
            <div class="aa-product-details-content">
              <div class="row">
                <!-- Modal view slider -->
                <div class="col-md-5 col-sm-5 col-xs-12">                              
                  <div class="aa-product-view-slider">                                
                    <div id="demo-1" class="simpleLens-gallery-container">
                      <div class="simpleLens-container">
                        <div class="simpleLens-big-image-container">
                            <a data-lens-image="http://via.placeholder.com/900x1024?text=Furkan" class="simpleLens-lens-image">
                                <img src="http://via.placeholder.com/250x300?text=Furkan" class="simpleLens-big-image">
                            </a>
                        </div>
                      </div>
                      <div class="simpleLens-thumbnails-container">
                          <a data-big-image="http://via.placeholder.com/250x300?text=Furkan1" 
                            data-lens-image="http://via.placeholder.com/900x1024?text=Furkan" class="simpleLens-thumbnail-wrapper" href="#">
                            <img src="http://via.placeholder.com/50x50?text=Furkan">
                          </a>                                    
                          <a data-big-image="http://via.placeholder.com/250x300?text=Furkan2" data-lens-image="http://via.placeholder.com/900x1024?text=Furkan" class="simpleLens-thumbnail-wrapper" href="#">
                            <img src="http://via.placeholder.com/50x50?text=Furkan">
                          </a>
                          <a data-big-image="http://via.placeholder.com/250x300?text=Furkan3" data-lens-image="http://via.placeholder.com/900x1024?text=Furkan" class="simpleLens-thumbnail-wrapper" href="#">
                            <img src="http://via.placeholder.com/50x50?text=Furkan">
                          </a>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal view content -->
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <div class="aa-product-view-content">
                    <h3>{{ $product->title }}</h3>
                    <div class="aa-price-block">
                        @if (!is_null($product->detail->old_price))
                            <span class="aa-product-price"><del>${{ $product->detail->old_price ?? null }}</del></span>
                        @endif
                        <span class="aa-product-view-price">${{ $product->price }}</span>
                      <p class="aa-product-avilability">Avilability: <span>{{ $product->detail->statu != 3 ? 'In stock' : 'SOLD OUT' }}</span></p>
                    </div>
                    @if ($product->detail->statu != 3 )
                        <h4>Size</h4>
                        <div class="aa-prod-view-size">
                        <a href="#">S</a>
                        <a href="#">M</a>
                        <a href="#">L</a>
                        <a href="#">XL</a>
                        </div>
                        <h4>Color</h4>
                        <div class="aa-color-tag">
                            <a href="#" class="aa-color-green"></a>
                            <a href="#" class="aa-color-yellow"></a>
                            <a href="#" class="aa-color-pink"></a>                      
                            <a href="#" class="aa-color-black"></a>
                            <a href="#" class="aa-color-white"></a>                      
                        </div>
                        <div class="aa-prod-quantity">
                        <form action="">
                            <select id="" name="">
                            <option selected="1" value="0">1</option>
                            <option value="1">2</option>
                            <option value="2">3</option>
                            <option value="3">4</option>
                            <option value="4">5</option>
                            <option value="5">6</option>
                            </select>
                        </form>
                        <p class="aa-prod-category">
                            Category: <a href="{{ route('category', $c->slug) }}">{{ $c->name }}</a>
                        </p>
                        </div>
                        
                        <div class="aa-prod-view-bottom">
                            <form action="{{ route('cart.add') }}" method="POST">
                              {{ csrf_field() }}
                              <input type="hidden" name="id" value="{{ $product->id }}">
                              <button class="aa-add-to-cart-btn"><span class="fa fa-shopping-cart"></span>Add To Cart</button>
                            </form>
                        </div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="aa-product-details-bottom">
              <ul class="nav nav-tabs" id="myTab2">
                <li><a href="#description" data-toggle="tab">Description</a></li>
                <li><a href="#review" data-toggle="tab">Reviews</a></li>                
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div class="tab-pane fade in active" id="description">
                    {!! $product->description !!}
                </div>
                <div class="tab-pane fade " id="review">
                 <div class="aa-product-review-area">
                   {{-- <h4>2 Reviews for T-Shirt</h4> 
                   <ul class="aa-review-nav">
                     <li>
                        <div class="media">
                          <div class="media-left">
                            <a href="#">
                              <img class="media-object" src="http://via.placeholder.com/150x150?text=Furkan" alt="girl image">
                            </a>
                          </div>
                          <div class="media-body">
                            <h4 class="media-heading"><strong>Marla Jobs</strong> - <span>March 26, 2016</span></h4>
                            <div class="aa-product-rating">
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star-o"></span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                          </div>
                        </div>
                      </li>
                   </ul> --}}
                   <h4>Add a review</h4>
                   <div class="aa-your-rating">
                     <p>Your Rating</p>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                   </div>
                   <!-- review form -->
                   <form action="" class="aa-review-form">
                      <div class="form-group">
                        <label for="message">Your Review</label>
                        <textarea class="form-control" rows="3" id="message"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name">
                      </div>  
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="example@gmail.com">
                      </div>

                      <button type="submit" class="btn btn-default aa-review-submit">Submit</button>
                   </form>
                 </div>
                </div>            
              </div>
            </div>
            <!-- Related product -->
            <div class="aa-product-related-item">
              <h3>Related Products</h3>
              <ul class="aa-product-catg aa-related-item-slider">
                @foreach ($setting['product'] as $product)
                    @if ($product->detail->statu == 1)
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
                        <span class="aa-badge aa-hot">HOT!</span>
                      </li>
                    @endif 
                @endforeach                                                                          
              </ul> 
            </div>  
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / product category -->


   @endsection