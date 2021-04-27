@extends('admin.layout.master')
@section('title', 'Admin | Categories')
@section('head')
<link rel="stylesheet" href="{{ mix('css/admin/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ mix('css/admin/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ mix('css/admin/dataTables.bootstrap4.min.css') }}">
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Orders</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <table id="info-table" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Price</th>
                        <th>Address</th>
                        <th>Statu</th>
                        <th>Created Date</th>
                        <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($orders as $order)
                        <tr>
                          <td>{{ $order->name . ' '. $order->surname }}</td>
                          <td>{{$order->phone}}</td>
                          <td>{{$order->email}}</td>
                          <td>{{$order->price}}</td>
                          <td>{{$order->address}}</td>
                          <td>
                            <span class="badge badge-{{ $order->statu == 'Order done' ? 'success' : ($order->statu == 'Wrong order!!!' ? 'danger' : 'info' )  }}">
                              {{$order->statu}}
                            </span> 
                          </td>
                          <td>{{ $order->created_at .' ('.timeConvert($order->created_at).')' }}</td>
                          <td style="display: flex; flex-direction: column; justify-content: space-around; align-items: center;">
                            <div style="display: flex; flex-direction: column; justify-content: space-around; align-items: center">
                              <a style="margin-bottom: .5rem" href="{{ route('admin.order-update', $order->id) }}" class="btn btn-info btn-sm">View</a>
                              <a style="margin-bottom: .5rem" href="#" class="btn btn-danger btn-sm">Delete</a>
                            </div>
                          </td>
                        </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Full Name</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Price</th>
                      <th>Address</th>
                      <th>Statu</th>
                      <th>Created Date</th>
                      <th></th>
                    </tr>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

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
