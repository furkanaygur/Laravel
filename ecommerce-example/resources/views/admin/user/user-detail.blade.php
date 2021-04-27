@extends('admin.layout.master')
@section('title', 'Admin | Edit User')
@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css" integrity="sha512-8vq2g5nHE062j3xor4XxPeZiPjmRDh6wlufQlfC6pdQ/9urJkU07NM0tEREeymP++NczacJ/Q59ul+/K2eYvcg==" crossorigin="anonymous" />
@endsection
@section('content')
        
    <!-- Content Header (Page header) -->
    <section class="content-header">
        @include('admin.layout.partials.alert')    
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit User</h1>
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
              <h3 class="card-title"><span class="text-warning">{{'#'.$user->id .' '.$user->name . ' '. $user->surname }}</span></h3>
  
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
                <div class="row">
                    <div class="col-md-8">
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                          <div class="card-body box-profile">
                            <div class="text-center">
                              <img class="profile-user-img img-fluid img-circle"
                                   src="/img/150x150.png"
                                   alt="User profile picture">
                            </div>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-4">
                        
                        <div class="form-group">
                            <label class="text-info">Register Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-info"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control text-info" value="{{ $user->created_at . ' ('.timeConvert($user->created_at).')' }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ route('admin.user-update', $user->id) }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
                                <label>Name*</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" placeholder="Name*">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group" {{ $errors->has('email') ? 'has-error' : null }}>
                                <label for="">Email*</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                                    </div>
                                    <input type="text" name="email" class="form-control" value="{{ old('email', $user->email) }}" placeholder="Email*">
                                </div>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('surname') ? 'has-error' : null }}">
                                <label>Lastname*</label>
                                <input type="text" class="form-control" name="surname" value="{{ old('surname', $user->surname) }}" placeholder="Lastname*">
                                @if ($errors->has('surname'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('surname') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group" {{ $errors->has('phone') ? 'has-error' : null }}>
                                <label for="">Phone*</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->detail->phone) }}" data-inputmask='"mask": "(999) 999-99-99"' data-mask>
                                </div>
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group" {{ $errors->has('address') ? 'has-error' : null }}>
                                <label for="">Address*</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                                    </div>
                                    <textarea class="form-control" name="address" placeholder="Address*" rows="5">{{ old('address', $user->detail->address) }}</textarea>
                                </div>
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-0">
                                <div class="icheck-danger d-inline mr-4">
                                    <input type="checkbox" name="isAdmin"  id="checkboxDanger1" {{ $user->isAdmin == 1 ? 'checked' : null }}>
                                    <label for="checkboxDanger1"> Admin </label>
                                </div>
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" name="active" id="checkboxSuccess1" {{ is_null($user->activation_key) ? 'checked' : null }}>
                                    <label for="checkboxSuccess1"> Active </label>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.5/jquery.inputmask.min.js" integrity="sha512-sR3EKGp4SG8zs7B0MEUxDeq8rw9wsuGVYNfbbO/GLCJ59LBE4baEfQBVsP2Y/h2n8M19YV1mujFANO1yA3ko7Q==" crossorigin="anonymous"></script>

<script>
    $('[data-mask]').inputmask();
</script>
@endsection