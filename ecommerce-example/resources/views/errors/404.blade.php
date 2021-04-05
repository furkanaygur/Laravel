@extends('layout.master')
@section('title', 'Page Not Found!') 
@section('content')
      <!-- 404 error section -->
  <section style="margin-bottom: 4rem" id="aa-error">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-error-area">
            <h2>404</h2>
            <span>Sorry! Page Not Found</span>
            <p>Sorry we couldn't find the page you were looking for .</p>
            <a href="{{ route('user.index') }}"> Go to Homepage</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / 404 error section -->
@endsection