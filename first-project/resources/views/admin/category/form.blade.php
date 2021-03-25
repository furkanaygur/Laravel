@extends('admin.layout.master')
@section('content')
    <h1 class="page-header"> Category Management</h1>
    <form action="{{ route('admin.category-save', @$category->id) }}" method="POST">
        {{ csrf_field() }}
        @include('layout.partials.error')
        @include('layout.partials.alert')
        <div class="pull-right">
            <button type="submit" style="background: #004684" class="btn btn-primary">
                {{ @$category->id > 0 ? 'Update' : 'Save' }}
            </button>
        </div>
        <h2>
            Category {{ @$category->id > 0 ? 'Edit' : 'Add' }}
        </h2>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="category_name">Category Name</label>
                    <input type="text" class="form-control" id="category_name" name="category_name" value="{{ old('category_name', $category->category_name) }}" placeholder="Category Name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="slug">Url</label>
                    <div style="position: relative">
                        <input type="hidden" name="original_slug" value="{{ $category->slug }}">
                        <input style="padding-left:19.5rem " type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $category->slug) }}" placeholder="Category Link">
                        <span style="position:  absolute; top:50%; left:1rem; transform: translateY(-50%); font-weight:600"> http://eticaret.test/category/ </span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="parent_id">Parent Category</label>
                    <select class="form-control" name="parent_id" id="parent_id">
                        <option value="">- Select Parent Category -</option>
                        @foreach ($all_categories as $c)
                            <option {{ $category->parent_id == $c->id ? 'selected' : null }} value="{{ $c->id }}">{{ $c->category_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @if ($category->id > 0)
            <div class="col-md-6">
                <div class="form-group">
                    <label for="created_at"> Creation Date</label>
                    <input type="text" class="form-control" name="created_at" id="created_at" value="{{ $category->created_at}} ({{ timeConvert($category->created_at) }})" readonly>
                </div>
            </div>
            @endif
        </div>
    </form>
@endsection