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
          <div style="display: flex; justify-content: flex-start; align-items: center" class="col-sm-4">
            <h1 style="margin-right: .5rem">Categories</h1>
            <a href="{{ route('admin.add-category') }}" class="btn btn-warning text-white"> Add New</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      @include('admin.layout.partials.alert')
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <table id="info-table" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Parent Category</th>
                        <th>Added Date</th>
                        <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{$category->slug}}</td>
                            <td>{{$category->parent_category($category->parent_id) }}</td>
                            <td>{{ $category->created_at .' ('.timeConvert($category->created_at).')' }}</td>
                            <td>
                              <div style="display: flex; justify-content: center; align-items: center">
                                <a style="margin-right: .5rem; margin-bottom: .5rem" href="{{ route('admin.category-update', $category->id) }}" class="btn btn-info btn-sm">View</a>
                                <a style="margin-bottom: .5rem" href="#" class="btn btn-danger btn-sm">Delete</a>
                              </div>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Parent Category</th>
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
