@extends('admin.layout.master')
@section('title', 'Admin | Products')
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
          <div style="display: flex; justify-content: flex-start; align-items: center" class="col-sm-4">
            <h1 style="margin-right: .5rem">Products</h1>
            <a href="{{ route('admin.add-product') }}" class="btn btn-warning text-white"> Add New</a>
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
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Slug</th>
                        <th>Price</th>
                        <th>In Index</th>
                        <th>Added Date</th>
                        <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td><img style="border-radius: 50%;" src="/img/50x50.png" ></td>
                            <td>{{ $product->title }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($product->description, 75, $end='...') }}</td>
                            <td>{{$product->slug}}</td>
                            <td>${{$product->price}}</td>
                            <td> <span class="badge badge-{{ $product->detail->in_index == 1 ? 'success' : 'danger'  }}">{{ $product->detail->in_index == 1 ? 'YES' : 'NO' }}</span> </td>
                            <td>{{ $product->created_at .' ('.timeConvert($product->created_at).')' }}</td>
                            <td>
                              <div style="display: flex; flex-direction: column; justify-content: space-around; align-items: center">
                                <a style="margin-bottom: .5rem" href="{{ route('admin.product-update', $product->id) }}" class="btn btn-info btn-sm">View</a>
                                <a style="margin-bottom: .5rem" href="#" class="btn btn-danger btn-sm">Delete</a>
                              </div>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>#</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Slug</th>
                      <th>Price</th>
                      <th>In Index</th>
                      <th>Added Date</th>
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
