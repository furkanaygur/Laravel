@extends('layout.master')
@section('title','Orders')
@section('content')
    <div class="container">
        <div class="bg-content">
            <h2>Siparişler</h2>
            @if(count($orders) == 0 ) 
                <p>Henüz siparişiniz yok</p>
            @else
                <table class="table table-bordererd table-hover">
                    <tr>
                        <th>Sipariş Kodu</th>
                        <th>Tutar</th>
                        <th>Toplam Ürün</th>
                        <th>Durum</th>
                        <th></th>
                    </tr>
                    @foreach ($orders as $order)
                        <tr>
                            <td>SP-{{ $order->id }}</td>
                            <td>{{ $order->price * ((100+config('cart.tax'))/100) }} ₺</td>
                            <td> {{ $order->cart->cart_product_piece() }}</td>
                            <td>
                                {{ $order->statu }}
                            </td>
                            <td><a style="background:#004684 !important; " href="{{ route('order_detail', $order->id) }}" class="btn btn-sm btn-info">Detay</a></td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </div>
@endsection