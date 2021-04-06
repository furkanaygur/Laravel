@extends('admin.layout.master')
@section('title', 'Admin | Edit Product')
@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css" integrity="sha512-8vq2g5nHE062j3xor4XxPeZiPjmRDh6wlufQlfC6pdQ/9urJkU07NM0tEREeymP++NczacJ/Q59ul+/K2eYvcg==" crossorigin="anonymous" />
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        @include('admin.layout.partials.alert')    
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Product</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <!-- SELECT2 EXAMPLE -->
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title"><span class="text-warning">{{'#'.$product->id .' '.$product->title }}</span></h3>
  
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route('admin.product-update', $product->id) }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : null }}">
                            <label>title*</label>
                            <input type="text" class="form-control" name="title" value="{{ old('title', $product->title) }}" placeholder="Title*">
                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group" {{ $errors->has('price') ? 'has-error' : null }}>
                            <label for="">Price*</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input type="text" name="price" class="form-control" value="{{ old('price', $product->price) }}" placeholder="Price*">
                            </div>
                            @if ($errors->has('price'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('price') }}</strong>
                                </span>
                            @endif
                        </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('slug') ? 'has-error' : null }}">
                                <label>Slug*</label>
                                <input type="text" class="form-control" name="slug" value="{{ old('slug', $product->slug) }}" placeholder="Slug*">
                                @if ($errors->has('slug'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('slug') }}</strong>
                                    </span>
                                @endif  
                            </div>
                            <div class="form-group" {{ $errors->has('old_price') ? 'has-error' : null }}>
                                <label for="">Old Price*</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    <input type="text" name="old_price" class="form-control" value="{{ old('old_price', $product->detail->old_price) }}" placeholder="Price*">
                                </div>
                                @if ($errors->has('old_price'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('old_price') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="category" class="form-control select2">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $product->categories[0]->id ? 'selected="selected"' : null }}> {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group {{ $errors->has('description') ? 'has-error' : null }}">
                                <label>Description*</label>
                                <textarea id="summernote" class="form-control" name="description" placeholder="Description*">{{ old('description', $product->description) }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-0">
                                <div class="icheck-success d-inline mr-4">
                                    <input type="checkbox" name="in_index"  id="checkboxDanger1" {{ $product->detail->in_index == 1 ? 'checked' : null }}>
                                    <label for="checkboxDanger1"> In Index </label>
                                </div>
                                <div class="d-inline float-right">
                                    <button class="btn btn-sm btn-info mr-2">Update</button>
                                    <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </form>
              <!-- /.row -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
    </section>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>

    $(function(){
        $('#summernote').summernote({
        placeholder: 'Hello Bootstrap 4',
        tabsize: 2,
        height: 150
      });
    })
</script>
@endsection