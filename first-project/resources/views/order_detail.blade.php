@extends('layout.master')
@section('title','Order Detail')
@section('content')
    <div class="container">
        <div class="bg-content">
            <a href="{{ route('orders') }}" style="background: #ffef03 !important; border:1px solid #ffef03; color:#004684;" class="btn btn-sm btn-warning"> <i class="fa fa-arrow-left"></i> Siparislere Dön</a>
            <h2>Sipariş (SP-{{ $order->id }})</h2>
            <table class="table table-bordererd table-hover">
                <tr>
                    <th colspan="2">Ürün</th>
                    <th>Tutar</th>
                    <th>Adet</th>
                    <th>Ara Toplam</th>
                </tr>
                @foreach ($order->cart->cart_product as $cart_product )
                    <tr>
                        <td><a href="{{ route('product', $cart_product->product->slug) }}"> <img height="100" src="http://via.placeholder.com/120x100?text=ProductPic"> </a></td>
                        <td><a href="{{ route('product', $cart_product->product->slug) }}"> {{ $cart_product->product->product_name }}</a></td>
                        <td>{{ $cart_product->price }}</td>
                        <td>{{ $cart_product->piece }}</td>
                        <td>{{ $cart_product->price * $cart_product->piece }}</td>
                    </tr>
                @endforeach
                    
                    
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Toplam Tutar</th>
                    <td>{{ $order->price }} ₺</td>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Sipariş Toplamı (KDV Dahil)</th>
                    <td>{{ $order->price * ((100+config('cart.tax'))/100) }} ₺</td>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Siparis Durum</th>
                    <td>{{ $order->statu }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection