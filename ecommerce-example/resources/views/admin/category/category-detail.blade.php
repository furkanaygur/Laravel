@extends('admin.layout.master')
@section('title', 'Admin | Edit Category')
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
            <h1>Edit Category</h1>
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
              <h3 class="card-title"><span class="text-warning">{{'#'.$category->id .' '.$category->name }}</span></h3>
              <a href="{{ route('category', $category->slug) }}" target="_blank" class="btn btn-info btn-xs ml-2">Go to Category</a>
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
                <form action="{{ route('admin.category-update', $category->id) }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
                              <label>Name*</label>
                              <input type="text" class="form-control" name="name" value="{{ old('name', $category->name) }}" placeholder="Name*">
                              @if ($errors->has('name'))
                                  <span class="help-block">
                                      <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                  </span>
                              @endif
                          </div>
                          <!-- /.form-group -->
                          <div class="form-group">
                              <label>Parent Category</label>
                              <select name="parent_id" class="form-control select2">
                                  <option> -- Choose Parent Category -- </option>
                                  @foreach ($categories as $c)
                                      <option value="{{ $c->id }}" {{ $category->parent_id == $c->id ? 'selected="selected"' : null }}> {{ $c->name }}</option>
                                  @endforeach
                              </select>
                          </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Slug*</label>
                                <input type="text" class="form-control" name="slug" value="{{ old('slug', $category->slug) }}" placeholder="Slug*"> 
                            </div>
                            <div class="form-group">
                              <label class="text-info">Created Date</label>
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text text-info"><i class="fas fa-calendar-alt"></i></span>
                                  </div>
                                  <input type="text" class="form-control text-info" value="{{ $category->created_at . ' ('.timeConvert($category->created_at).')' }}" readonly>
                              </div>
                              
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-0">
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