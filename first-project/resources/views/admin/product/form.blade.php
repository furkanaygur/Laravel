@extends('admin.layout.master')
@section('content')
    <h1 class="page-header"> Product Management</h1>
    <form action="{{ route('admin.product-save', @$product->id) }}" method="POST">
        {{ csrf_field() }}
        @include('layout.partials.error')
        @include('layout.partials.alert')
        <div class="pull-right">
            <button type="submit" style="background: #004684" class="btn btn-primary">
                {{ @$product->id > 0 ? 'Update' : 'Save' }}
            </button>
        </div>
        <h2>
            Product {{ @$product->id > 0 ? 'Edit' : 'Add' }}
        </h2>
 
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" value="{{ old('product_name', $product->product_name) }}" placeholder="Product Name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="slug">Url</label>
                    <div style="position: relative">
                        <input type="hidden" name="original_slug" value="{{ $product->slug }}">
                        <input style="padding-left:18.8rem " type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $product->slug) }}" placeholder="Product Link">
                        <span style="position:  absolute; top:50%; left:1rem; transform: translateY(-50%); font-weight:600"> http://eticaret.test/product/ </span>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="product_description">Product Descipriton</label>
                    <textarea type="text" class="form-control" id="product_description" name="product_description" rows="8" placeholder="Product Description">{{ old('product_description', $product->product_description) }}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="Creation Date">Price</label>
                    <div style="position: relative">
                        <input type="text" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" placeholder="Price">
                        <span style="position:  absolute; top:50%; right:1rem; transform: translateY(-50%); font-weight:600"> ₺ </span>
                    </div>
                </div>
            </div>
            @if ($product->id > 0)
            <div class="col-md-6">
                <div class="form-group">
                    <label for="created_at">Creation Date</label>
                    <input type="text" class="form-control" name="created_at" id="created_at" value="{{ $product->created_at}} ({{ timeConvert($product->created_at) }})" readonly>
                </div>
            </div>
            @endif
        </div>
    </form>
@endsection