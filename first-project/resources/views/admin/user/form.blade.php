@extends('admin.layout.master')
@section('content')
    <h1 class="page-header"> User Management</h1>
    <form action="{{ route('admin.user-save', @$user->id) }}" method="POST">
        {{ csrf_field() }}
        @include('layout.partials.error')
        @include('layout.partials.alert')
        <div class="pull-right">
            <button type="submit" style="background: #004684" class="btn btn-primary">
                {{ @$user->id > 0 ? 'Update' : 'Save' }}
            </button>
        </div>
        <h2>
            User {{ @$user->id > 0 ? 'Edit' : 'Add' }}
        </h2>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="full_name">Name Surname</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name', $user->full_name) }}" placeholder="Email">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Email">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" id="address" value="{{ old('address', $user->detail->address) }}" placeholder="Add Address">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone1">Phone1</label>
                    <input type="text" class="form-control telefon" id="phone" name="phone" value="{{ old('phone', $user->detail->phone) }}" placeholder="Phone">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone2">Phone2</label>
                    <input type="text" class="form-control telefon" name="phone2" id="phone2" value="{{ old('phone2', $user->detail->phone2) }}" placeholder="Phone 2">
                </div>
            </div>
        </div>
        <div class="checkbox">
            <label>
                <input type="hidden" name="isActive" value="0">
                <input name="isActive" value="1" {{ old('isActive', $user->isActive) ? 'checked' : null }} type="checkbox"> Is Active
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="hidden" name="isAdnin" value="0">
                <input name="isAdmin" value="1" {{ old('isAdmin', $user->isAdmin) ? 'checked' : null }} type="checkbox"> Is Admin
            </label>
        </div>
    </form>

@endsection
@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
    <script>
        $('.telefon').mask('(000) 000-00-00', { placeholder: "(___) ___-__-__" });
    </script>
@endsection