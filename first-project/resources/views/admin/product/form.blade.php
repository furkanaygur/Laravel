@extends('admin.layout.master')
@section('head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <h1 class="page-header"> Product Management</h1>
    <form action="{{ route('admin.product-save', @$product->id) }}" method="POST" enctype="multipart/form-data">
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
        <div class="checkbox-container">
            <label>
                <input type="hidden" name="display_slider" value="0">
                <input type="checkbox" name="display_slider" value="1" {{ old('display_slider', $product->detail->display_slider) ? 'checked' : null  }}>
                Slider
            </label>
            <label>
                <input type="hidden" name="display_opportunity" value="0">
                <input type="checkbox" name="display_opportunity" value="1" {{ old('display_opportunity', $product->detail->display_opportunity) ? 'checked' : null  }}>
                Opportunity
            </label>
            <label>
                <input type="hidden" name="display_best_seller" value="0">
                <input type="checkbox" name="display_best_seller" value="1" {{ old('display_best_seller', $product->detail->display_best_seller) ? 'checked' : null  }}>
                Best Seller
            </label>
            <label>
                <input type="hidden" name="display_discount" value="0">
                <input type="checkbox" name="display_discount" value="1" {{ old('display_discount', $product->detail->display_discount) ? 'checked' : null  }}>
                Discount
            </label>
        </div>
        <div style="margin-top: 1rem" class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="product_name">Categories</label>
                    <select name="categories[]" class="form-control" id="categories" multiple>
                        @foreach ($all_categories as $category)
                            <option {{ collect(old('categories', $product_categories))->contains($category->id) ? 'selected' : null }} value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="product_image">Product Image</label>
            @if($product->detail->product_image != null)
                <img src="/uploads/product/{{ $product->detail->product_image }}" class="thumbnail pull-left" style="height: 250px; margin-right: 2rem" alt="{{ $product->product_name }}">
            @endif
            <input type="file" id="product_image" name="product_image">
        </div>
    </form>
@endsection
@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function(){
            $('#categories').select2({
                placeholder:'Please choose a category'
            });
        });
    </script>
@endsection