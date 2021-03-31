@extends('layout.master')
@section('title', 'Shopping Cart')
@section('head')
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
  .aa-secondary-btn:hover {
    background: black;
  }
</style>
@endsection
@section('content')
@include('layout.partials.alert')
 <!-- catg header banner section -->
 <section id="aa-catg-head-banner">
    <img src="http://via.placeholder.com/1920x300?text=Furkan" alt="fashion img">
    <div class="aa-catg-head-banner-area">
        <div class="container">
        <div class="aa-catg-head-banner-content">
            <h2>Cart Page</h2>
            <ol class="breadcrumb">
            <li><a href="{{ route('user.index') }}">Home</a></li>                   
            <li class="active">Cart</li>
            </ol>
        </div>
        </div>
    </div>
</section>
<!-- / catg header banner section -->


 <!-- Cart view section -->
 <section id="cart-view">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          @if(count(Cart::content()) > 0)
          <div class="cart-view-area">
            <div class="cart-view-table">
                <div class="table-responsive">
                   <table class="table">
                     <thead>
                       <tr>
                         <th></th>
                         <th></th>
                         <th>Product</th>
                         <th>Price</th>
                         <th>Quantity</th>
                         <th>Total</th>
                       </tr>
                     </thead>
                     <tbody>
                       @foreach (Cart::content() as $product )
                          <tr>
                            <td>
                              <form action="{{ route('cart.delete', $product->rowId) }}" method="POST">
                                  {{ csrf_field() }}
                                  {{ method_field('DELETE') }}
                                  <input style="font-family: FontAwesome; background: transparent; border:none;" class="remove" value="&#xf00d;" type="submit">
                                </form>
                            </td>
                            <td><a href="{{ route('category.product', [$product->options->category, $product->options->slug]) }}"><img src="http://via.placeholder.com/250x300?text=Furkan" alt="img"></a></td>
                            <td><a class="aa-cart-title" href="{{ route('category.product', [$product->options->category, $product->options->slug]) }}">{{ $product->name }}</a></td>
                            <td>${{ $product->price }}</td>
                            <td>
                              <a href="javascript:void(0)" class="btn btn-xs btn-info minus" data-piece="{{ $product->qty - 1 }}" data-id="{{ $product->rowId }}"> - </a>
                              <span class="aa-cart-quantity">{{ $product->qty }} </span>
                              <a href="javascript:void(0)" class="btn  btn-xs btn-info add" data-piece="{{ $product->qty + 1 }}" data-id="{{ $product->rowId }}">+</a>
                            </td>
                            <td>${{ $product->subtotal }}</td>
                          </tr>
                       @endforeach
                          <tr>
                            <td colspan="6" class="aa-cart-view-bottom">
                                <form action="{{ route('cart.clear') }}" method="POST">
                                  {{ csrf_field() }}
                                  {{ method_field('DELETE') }}
                                  <button style="background: red" class="aa-cart-view-btn">CLEAR CART</button>
                                </form>
                            </td>
                          </tr>
                       </tbody>
                   </table>
                 </div>
              <!-- Cart Total view -->
              <div class="cart-view-total">
                <h4>Cart Totals</h4>
                <table class="aa-totals-table">
                  <tbody>
                    <tr>
                      <th>Subtotal</th>
                      <td>${{ Cart::subtotal() }}</td>
                    </tr>
                    <tr>
                      <th>Tax</th>
                      <td>${{ Cart::tax() }}</td>
                    </tr>
                    <tr>
                      <th>Total</th>
                      <td>${{ Cart::total() }}</td>
                    </tr>
                  </tbody>
                </table>
                <a href="#" class="aa-cart-view-btn">Complete The Order </a>
              </div>
            </div>
          </div>
          @else
            <div class="container">
              <div style="height:150px; display: flex; flex-direction:column; justify-content: center; align-items:center; background-color: #37c6f5; color: white;" class="w3-panel">
                <h3>Shopping cart is empty</h3>
                <a class="aa-secondary-btn" href="{{ route('user.index') }}">Start Shopping</a>
              </div> 
            </div>
          @endif
        </div>
      </div>
    </div>
  </section>
  <!-- / Cart view section -->



@endsection