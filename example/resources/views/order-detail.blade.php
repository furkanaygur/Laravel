@extends('layout.master')
@section('title', 'Order Detail')
@section('content')

<section id="aa-catg-head-banner">
    <img src="/img/1920x300.png" alt="">
    <div class="aa-catg-head-banner-area">
        <div class="container">
        <div class="aa-catg-head-banner-content">
            <h2> SP-{{ $order->id }} Order Detail</h2>
            <ol class="breadcrumb">
            <li><a href="{{ route('user.index') }}">Home</a></li>                   
            <li><a href="{{ route('order') }}">Orders</a></li>                   
            <li class="active">Order Detail</li>
            </ol>
        </div>
        </div>
    </div>
</section>


<section id="cart-view">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="cart-view-area">
            <div class="cart-view-table">
              <form action="">
                <div class="table-responsive">
                   <table class="table">
                     <thead>
                       <tr>
                         <th></th>
                         <th>Product</th>
                         <th>Price</th>
                         <th>Quantity</th>
                         <th>Statu</th>
                         <th>Subtotal</th>
                       </tr>
                     </thead>
                     <tbody>
                       @foreach ($order->cart->cart_products as $ord)
                        <tr>
                            <td><a href="{{ route('category.product', [$ord->product->categories[0]->slug, $ord->product->slug]) }}"><img src="/img/150x150.png" alt="img"></a></td>
                            <td><a class="aa-cart-title" href="{{ route('category.product', [$ord->product->categories[0]->slug, $ord->product->slug]) }}">{{ $ord->product->title }}</a></td>
                            <td>$ {{ $ord->price }}</td>
                            <td><input class="aa-cart-quantity" type="number" value="{{ $ord->piece }}" readonly></td>
                            <td>{{ $ord->statu }}</td>
                            <td>${{ $ord->price * $ord->piece }}</td>
                        </tr> 
                       @endforeach
                       </tbody>
                   </table>
                 </div>
              </form>
              <!-- Cart Total view -->
              <div class="cart-view-total">
                <h4>Order Totals</h4>
                <table class="aa-totals-table">
                  <tbody>
                    <tr>
                      <th>Subtotal</th>
                      <td>${{ $order->price }}</td>
                    </tr>
                    <tr>
                      <th>Tax</th>
                      <td>${{ $order->price * ((config('cart.tax'))/100) }}</td>
                    </tr>
                    <tr>
                      <th>Total</th>
                      <td>${{ $order->price * ((100+config('cart.tax'))/100) }}</td>
                    </tr>
                    <tr>
                      <th>Statu</th>
                      <td>{{ $order->statu }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection