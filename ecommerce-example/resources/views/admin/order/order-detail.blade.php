@extends('admin.layout.master')
@section('title', 'Admin | Edit Order')
@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css" integrity="sha512-8vq2g5nHE062j3xor4XxPeZiPjmRDh6wlufQlfC6pdQ/9urJkU07NM0tEREeymP++NczacJ/Q59ul+/K2eYvcg==" crossorigin="anonymous" />
<link rel="stylesheet" href="{{ mix('css/admin/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ mix('css/admin/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ mix('css/admin/dataTables.bootstrap4.min.css') }}">
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        @include('admin.layout.partials.alert')    
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Order</h1>
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
              <h3 class="card-title"><span class="text-warning">{{'#SP-'.$order->id }}</span></h3>
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
                <form action="{{ route('admin.order-update', $order->id) }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
                                <label>Name*</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $order->name) }}" placeholder="Name*">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('name') }}</strong>
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
                                    <input type="text" name="price" class="form-control" value="{{ old('price', $order->price) }}" placeholder="Price*">
                                </div>
                                @if ($errors->has('price'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group" {{ $errors->has('email') ? 'has-error' : null }}>
                                <label for="">Email*</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                                    </div>
                                    <input type="text" name="email" class="form-control" value="{{ old('email', $order->email) }}" placeholder="Email*">
                                </div>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Statu</label>
                                <select name="statu" class="form-control select2">
                                    <option class="text-danger"  {{ $order->statu == 'Wrong order!!!' ? 'selected="selected"' : null }}> Wrong order!!!  </option>
                                    <option class="text-yellow"  {{ $order->statu == 'Your order is preparing' ? 'selected="selected"' : null }}> Your order is preparing </option>
                                    <option class="text-success"  {{ $order->statu == 'Order done' ? 'selected="selected"' : null }}> Order done </option>
                                </select>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('surname') ? 'has-error' : null }}">
                                <label>Lastname*</label>
                                <input type="text" class="form-control" name="surname" value="{{ old('surname', $order->surname) }}" placeholder="Lastname*"> 
                                @if ($errors->has('surname'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('surname') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <div class="form-group {{ $errors->has('phone') ? 'has-error' : null }}">
                                <label for="">Phone*</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $order->phone) }}" placeholder="Phone*">
                                </div>
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('bank') ? 'has-error' : null }}">
                                <label for="">Bank*</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-landmark"></i></span>
                                    </div>
                                    <input type="text" name="bank" class="form-control" value="{{ old('bank', $order->bank) }}" placeholder="Bank*">
                                    @if ($errors->has('bank'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('bank') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="text-info">Created Date</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-info"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control text-info" value="{{ $order->created_at . ' ('.timeConvert($order->created_at).')' }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group" {{ $errors->has('address') ? 'has-error' : null }}>
                                <label for="">Address*</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                                    </div>
                                    <textarea class="form-control" name="address" placeholder="Address*" rows="5">{{ old('address', $order->address) }}</textarea>
                                </div>
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <table id="info-table" class="table table-bordered table-hover">
                                <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>Title</th>
                                      <th>Quantity</th>
                                      <th>Price</th>
                                      <th>Statu</th>
                                      <th>Subtotal</th>
                                      <th></th>
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach ($order->cart->cart_products as $ord)
                                <tr>
                                    <td><img src="/img/150x150.png" alt="img"></td>
                                    <td>{{ $ord->product->title }}</td>
                                    <td>$ {{ $ord->price }}</td>
                                    <td><input style="width: 75px;" class="form-control" type="number" value="{{ $ord->piece }}" readonly></td>
                                    <td>{{ $ord->statu }}</td>
                                    <td>${{ $ord->price * $ord->piece }}</td>
                                    <td>
                                        <div style="display: flex; justify-content: space-around; align-items: center">
                                            <a class="btn btn-sm btn-info " target="_blank" href="{{ route('category.product', [$ord->product->categories[0]->slug, $ord->product->slug]) }}">Go To Product</a>
                                        </div>
                                    </td>

                                @endforeach
                                </tbody>
                              </table>

                            <div class="form-group mt-5 mb-0">
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
<script src="{{ mix('js/admin/jquery.dataTables.min.js') }}"></script>
<script src="{{ mix('js/admin/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ mix('js/admin/dataTables.responsive.min.js') }}"></script>
<script src="{{ mix('js/admin/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ mix('js/admin/dataTables.buttons.min.js') }}"></script>
<script src="{{ mix('js/admin/buttons.bootstrap4.min.js') }}"></script>
<script>
    $(function () {
      $('#info-table').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
@endsection