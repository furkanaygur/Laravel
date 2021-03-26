@extends('admin.layout.master')
@section('head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <h1 class="page-header"> Order Management</h1>
    <form action="{{ route('admin.order-save', @$order->id) }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        @include('layout.partials.error')
        @include('layout.partials.alert')
        <div class="pull-right">
            <button type="submit" style="background: #004684" class="btn btn-primary">
                {{ @$order->id > 0 ? 'Update' : 'Save' }}
            </button>
        </div>
        <h2>
            Order {{ @$order->id > 0 ? 'SP-'.$order->id.' Edit' : 'Add' }}
        </h2>
 
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="full_name">Customer Name</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name', $order->cart->user->full_name) }}" placeholder="Customer Name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $order->address) }}" placeholder="Order Address">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $order->phone) }}" placeholder="Customer Phone">
                </div>
            </div>
            @if($order->phone2)
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone2">Phone2</label>
                    <input type="text" class="form-control" id="phone2" name="phone2" value="{{ old('phone2', $order->phone2) }}" placeholder="Customer Phone2">
                </div>
            </div>
            @endif
            <div class="col-md-6">
                <div class="form-group">
                    <label for="Creation Date">Price</label>
                    <div style="position: relative">
                        <input type="text" class="form-control" id="price" name="price" value="{{ old('price',$order->price * ((100+config('cart.tax'))/100)) }}" placeholder="Price">
                        <span style="position:  absolute; top:50%; right:1rem; transform: translateY(-50%); font-weight:600"> ₺ </span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="bank">Bank</label>
                    <input type="text" class="form-control" id="bank" name="bank" value="{{ old('bank', $order->bank) }}" placeholder="Bank">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="installment">Installment</label>
                    <input type="text" class="form-control" id="installment" name="installment" value="{{ old('installment', $order->installment) }}" placeholder="Customer Phone2">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="statu">Order Statu</label>
                    <select name="statu" class="form-control" id="statu">
                        <option {{ old('statu', $order->statu) == 'Order has been taken' ? 'selected' : null }} >Order has been taken</option>
                        <option {{ old('statu', $order->statu) == 'Payment accepted' ? 'selected' : null }} >Payment accepted</option>
                        <option {{ old('statu', $order->statu) == 'Given to cargo' ? 'selected' : null }} >Given to cargo</option>
                        <option {{ old('statu', $order->statu) == 'Done' ? 'selected' : null }} >Done</option>
                    </select>
                </div>
            </div>
            @if ($order->id > 0)
            <div class="col-md-6">
                <div class="form-group">
                    <label for="created_at">Creation Date</label>
                    <input type="text" class="form-control" name="created_at" id="created_at" value="{{ $order->created_at}} ({{ timeConvert($order->created_at) }})" readonly>
                </div>
            </div>
            @endif
        </div>
    </form>
    <table class="table table-bordererd table-hover">
        <tr>
            <th colspan="2">Ürün</th>
            <th>Tutar</th>
            <th>Adet</th>
            <th>Ara Toplam</th>
        </tr>
        @foreach ($order->cart->cart_product as $cart_product )
            <tr>
                <td><a href="{{ route('product', $cart_product->product->slug) }}"> <img style="width: 155px" class="thumbnail" src="{{ $cart_product->product->detail->product_image  != null ? asset('uploads/product/'. $cart_product->product->detail->product_image ) : 'http://via.placeholder.com/400x400?text=ProductPic' }}" alt="{{ $cart_product->product->product_name  }}" > </a></td>
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
            <th>KDV Tutarı</th>
            <td>{{ $order->price * ((config('cart.tax'))/100) }} ₺</td>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th>Sipariş Toplamı (KDV Dahil)</th>
            <td>{{ $order->price * ((100+config('cart.tax'))/100) }} ₺</td>
        </tr>
    </table>
@endsection