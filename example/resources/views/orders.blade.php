@extends('layout.master')
@section('title', 'Orders')
@section('head')
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
  .aa-secondary-btn:hover {
    background: black;
  }
</style>
@endsection
@section('content')
<section id="aa-catg-head-banner">
    <img src="/img/1920x300.png" alt="">
    <div class="aa-catg-head-banner-area">
        <div class="container">
        <div class="aa-catg-head-banner-content">
            <h2>Orders</h2>
            <ol class="breadcrumb">
            <li><a href="{{ route('user.index') }}">Home</a></li>                   
            <li class="active">Orders</li>
            </ol>
        </div>
        </div>
    </div>
</section>

<section id="cart-view">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          @if(count($orders) > 0 )
          <div class="cart-view-area">
            <div class="cart-view-table aa-wishlist-table">
                <div class="table-responsive">
                   <table class="table">
                     <thead>
                       <tr>
                         <th>#</th>
                         <th>Adress</th>
                         <th>Product Piece</th>
                         <th>Price</th>
                         <th>Statu</th>
                         <th></th>
                       </tr>
                     </thead>
                     <tbody>
                       @foreach ($orders as $order)
                       <tr>
                            <td>SP-{{ $order->id }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->cart->product_piece() }}</td>
                            <td>${{ $order->price }}</td>
                            <td>{{ $order->statu }}</td>
                            <td><a href="{{ route('order.detail', $order->id) }}" class="aa-add-to-cart-btn">Detail</a></td>
                        </tr>
                       @endforeach                     
                       </tbody>
                   </table>
                 </div>
            </div>
          </div>
          @else
          <div style="margin: 2rem 0" class="container">
            <div style="height:150px; display: flex; flex-direction:column; justify-content: center; align-items:center; background-color: #37c6f5; color: white;" class="w3-panel">
              <h3>There is no order</h3>
              <a class="aa-secondary-btn" href="{{ route('user.index') }}">Start Shopping</a>
            </div> 
          </div>
          @endif
        </div>
      </div>
    </div>
  </section>

@endsection