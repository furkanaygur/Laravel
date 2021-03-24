@extends('layout.master')
@section('title','Page Not Found!')
@section('content')
<div class="container">
    <div class="jumbotron text-center">
        <h1>404</h1>
        <h2>Page Not Found</h2>
        <a href="{{ route('index') }}"  style="background: #004684 !important;" class="btn btn-info">Home</a>
    </div>
</div>
@endsection