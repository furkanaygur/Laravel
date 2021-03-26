@extends('admin.layout.master')
@section('content')
    <h1 class="page-header">Order Management</h1>
    <h3 class="sub-header">Order List </h3>
    <div class="well">
        <div class="btn-group pull-right" role="group" aria-label="Basic example">
            <a href="{{ route('admin.order-create') }}" class="btn btn-primary">Add Order</a>
        </div>
        <form action="{{ route('admin.orders') }}" class="form-inline">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="search_key">Search</label>
                <input type="text" id="search_key" name="search_key" class="form-control" placeholder="Type Name, Address..."
                value="{{ old('search_key') }}">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{ route('admin.orders') }}" class="btn btn-danger" >Clear</a>
        </form>
    </div>
    @include('layout.partials.alert')
    @include('layout.partials.error')
    <div class="table-responsive">
        @if (count($orders) > 0)
            <table class="table table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Cart ID</th>
                        <th>Customer Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Price</th>
                        <th>Bank</th>
                        <th>Installment</th>
                        <th>Statu</th>
                        <th>Creation Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order )
                        <tr>
                            <td>SP-{{ $order->id }}</td>
                            <td>{{ $order->cart->user->full_name }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->price * ((100 + config('cart.tax')) /100) }} ₺</td>
                            <td>{{ $order->bank }}</td>
                            <td>{{ $order->installment }}</td>
                            <td>{{ $order->statu }}</td>
                            <td>{{ $order->created_at .' ('. timeConvert($order->created_at) .')' }}</td>
                            <td style="width: 100px">
                                <a href="{{ route('admin.order-update', $order->id) }}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Update">
                                    <span class="fa fa-pencil"></span>
                                </a>
                                <a href="{{ route('admin.order-delete', $order->id) }}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you sure?')">
                                    <span class="fa fa-trash"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning">
                There is nothing...
            </div>
        @endif
        {{ $orders->links() }}
    </div>
@endsection