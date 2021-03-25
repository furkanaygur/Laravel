@extends('admin.layout.master')
@section('content')
    <h1 class="page-header">Product Management</h1>
    <h3 class="sub-header"> Product List </h3>
    <div class="well">
        <div class="btn-group pull-right" role="group" aria-label="Basic example">
            <a href="{{ route('admin.product-create') }}" class="btn btn-primary">Add Product</a>
        </div>
        <form action="{{ route('admin.products') }}" class="form-inline">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="search_key">Search</label>
                <input type="text" id="search_key" name="search_key" class="form-control" placeholder="Type Product Name, Description..."
                value="{{ old('search_key') }}">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{ route('admin.products') }}" class="btn btn-danger" >Clear</a>
        </form>
    </div>
    @include('layout.partials.alert')
    @include('layout.partials.error')
    <div class="table-responsive">
        @if (count($products) > 0)
            <table class="table table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Link</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Creation Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product )
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ route('product', $product->slug) }} </td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{  \Illuminate\Support\Str::limit($product->product_description, 100, $end='...') }}</td>
                            <td>{{ $product->price }} ₺</td>
                            <td> 
                            @foreach ($product->categories as $category )
                                {{ $category->category_name }}, 
                            @endforeach    
                            </td>
                            <td>{{ $product->created_at .' ('. timeConvert($product->created_at) .')' }}</td>
                            <td style="width: 100px">
                                <a href="{{ route('admin.product-update', $product->id) }}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Update">
                                    <span class="fa fa-pencil"></span>
                                </a>
                                <a href="{{ route('admin.product-delete', $product->id) }}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you sure?')">
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
        {{ $products->links() }}
    </div>
@endsection