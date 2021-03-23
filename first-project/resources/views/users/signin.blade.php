@extends('layout.master')
@section('title','Signin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Kaydol</div>
                    <div class="panel-body">
                        {{-- @include('layout.partials.error') --}}
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('users.signin_form') }}">
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('full_name') ? 'has-error' : null }}"> 
                                <label for="name" class="col-md-4 control-label">Ad Soyad</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="full_name" value="{{ old('full_name') }}">
                                    @if ($errors->has('full_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('full_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('email') ? 'has-error' : null }}">
                                <label for="email" class="col-md-4 control-label">Email</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('password') ? 'has-error' : null }}">
                                <label for="password" class="col-md-4 control-label">Şifre</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : null }}">
                                <label for="password-confirm" class="col-md-4 control-label">Şifre (Tekrar)</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Kaydol
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection