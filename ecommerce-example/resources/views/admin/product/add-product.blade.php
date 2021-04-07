@extends('admin.layout.master')
@section('title', 'Admin | Add New Product')
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
            <h1>Add New Product</h1>
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
              <h3 class="card-title"><span class="text-warning">New Product</span></h3>
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
                <form action="{{ route('admin.add-product') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : null }}">
                            <label>title*</label>
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Title*">
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
                                <input type="text" name="price" class="form-control" value="{{ old('price') }}" placeholder="Price*">
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
                            <div class="form-group">
                                <label>Slug*</label>
                                <input type="text" class="form-control" name="slug" value="{{ old('slug') }}" placeholder="Slug*"> 
                            </div>
                            <div class="form-group">
                                <label for="">Old Price*</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    <input type="text" name="old_price" class="form-control" value="{{ old('old_price') }}" placeholder="Price*">
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="category" class="form-control select2">
                                    <option value=""> -- Choose a Category -- </option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == old('category') ? 'selected="selected"' : null }}> {{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Statu</label>
                                <select name="statu" class="form-control select2">
                                    <option value=""> -- Choose a Category -- </option>
                                    <option class="text-green" value="1" {{ old('statu') == 1 ? 'selected="selected"' : null }}> SALE! </option>
                                    <option class="text-orange" value="2" {{ old('statu') == 2 ? 'selected="selected"' : null }}> HOT! </option>
                                    <option class="text-danger" value="3" {{ old('statu') == 3 ? 'selected="selected"' : null }}> SOLD OUT! </option>
                                </select>
                                @if ($errors->has('statu'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('statu') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description*</label>
                                <textarea id="summernote" class="form-control" name="description" placeholder="Description*">{{ old('description') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-0">
                                <div class="icheck-success d-inline mr-4">
                                    <input type="checkbox" name="in_index"  id="checkboxDanger1" {{ old('in_index') == 1 ? 'checked' : null }}>
                                    <label for="checkboxDanger1"> In Index </label>
                                </div>
                                <div class="d-inline float-right">
                                    <button class="btn btn-sm btn-success mr-2">Save</button>
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
        placeholder: 'Product Description',
        tabsize: 2,
        height: 150
      });
    })
</script>
@endsection