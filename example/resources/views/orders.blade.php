@extends('layout.master')
@section('title', 'Orders')
@section('content')
<section id="aa-catg-head-banner">
    <img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img">
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
          <div class="cart-view-area">
            <div class="cart-view-table aa-wishlist-table">
                <div class="table-responsive">
                   <table class="table">
                     <thead>
                       <tr>
                         <th>Adress</>
                         <th>Price</th>
                         <th>Statu</th>
                         <th></th>
                       </tr>
                     </thead>
                     <tbody>
                       @foreach ($orders as $order)
                       <tr>
                            <td>{{ $order->address }}</td>
                            <td>${{ $order->price }}</td>
                            <td>{{ $order->statu }}</td>
                            <td><a href="#" class="aa-add-to-cart-btn">Detail</a></td>
                        </tr>
                       @endforeach                     
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