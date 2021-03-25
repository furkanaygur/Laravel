@extends('admin.layout.master')
@section('content')
    <h1 class="page-header">Category Management</h1>
    <h3 class="sub-header"> Category List </h3>
    <div class="well">
        <div class="btn-group pull-right" role="group" aria-label="Basic example">
            <a href="{{ route('admin.category-create') }}" class="btn btn-primary">Add Category</a>
        </div>
        <form action="{{ route('admin.categories') }}" class="form-inline">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="search_key">Search</label>
                <input type="text" id="search_key" name="search_key" class="form-control" placeholder="Type Category Name..."
                value="{{ old('search_key') }}"
                >
                <select class="form-control" name="byParent_category">
                    <option value="">-Choose Parent Category-</option>
                   @foreach ($parent_categories as $pc )
                        <option {{ old('byParent_category') == $pc->id ? 'selected' : null }} value="{{ $pc->id }}">{{ $pc->category_name }}</option>
                   @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{ route('admin.categories') }}" class="btn btn-danger" >Clear</a>
        </form>
    </div>
    @include('layout.partials.alert')
    @include('layout.partials.error')
    <div class="table-responsive">
        @if (count($categories) > 0)
            <table class="table table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Link</th>
                        <th>Parent Category</th>
                        <th>Category Name</th>
                        <th>Creation Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($categories as $category )
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ route('category', $category->slug) }} </td>
                                <td>{{ $category->parent_category->category_name }}</td>
                                <td>{{ $category->category_name }}</td>
                                <td>{{ $category->created_at .' ('. timeConvert($category->created_at) .')' }}</td>
                                <td style="width: 100px">
                                    <a href="{{ route('admin.category-update', $category->id) }}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Update">
                                        <span class="fa fa-pencil"></span>
                                    </a>
                                    <a href="{{ route('admin.category-delete', $category->id) }}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you sure?')">
                                        <span class="fa fa-trash"></span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning">
                There is nothing...
            </div>
        @endif
        {{ $categories->links() }}
    </div>
@endsection