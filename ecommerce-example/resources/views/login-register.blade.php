@extends('layout.master')
@section('title', 'Login Or Register')
@section('content')
<!-- catg header banner section -->
<section id="aa-catg-head-banner">
    <img src="http://via.placeholder.com/1920x300?text=Furkan" alt="fashion img">
    <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Account Page</h2>
        <ol class="breadcrumb">
          <li><a href="{{ route('user.index') }}">Home</a></li>                   
          <li class="active">Account</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

  <section id="aa-myaccount">
    <div class="container">
      <div class="row">
        <div style="margin-top:4rem; margin-bottom: 7rem" class="col-md-12">  
          @include('layout.partials.alert')   
             <!-- start prduct navigation -->
          <ul class="nav nav-tabs aa-products-tab">
            <li class="{{ session()->has('message_type') ? null : 'active' }}"><a href="#register" data-toggle="tab">Register</a></li>
            <li class="{{ session()->has('message_type') ? 'active' : null }}" ><a href="#login" data-toggle="tab">Login</a></li>
          </ul>
            <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane fade in {{ session()->has('message_type') ? null : 'active' }}" id="register">
              <div class="aa-myaccount-register"> 
                <h4>Register</h4>
                <form action="{{ route('user.signin') }}" class="aa-login-form" method="POST">
                  {{ csrf_field() }}
                  <label for="">Name<span>*</span></label>
                  <input type="text" name="name" value="{{ old('name') }}" placeholder="Name">
                  <label for="">Surname<span>*</span></label>
                  <input type="text" name="surname" value="{{ old('surname') }}" placeholder="Surname">
                  <label for="">Email address<span>*</span></label>
                  <input type="text" name="email" value="{{ old('email') }}" placeholder="Email">
                  <label for="">Password<span>*</span></label>
                  <input type="password" name="password" placeholder="Password">
                  <button type="submit" class="aa-browse-btn">Register</button>                    
                </form>
              </div>
            </div>
            <div class="tab-pane fade in {{ session()->has('message_type') ? 'active' : null }}" id="login">
                <div class="aa-myaccount-login">
                  <h4>Login</h4>
                  <form action="{{ route('user.login') }}" class="aa-login-form" method="POST">
                    {{ csrf_field() }}
                  <label for="">Email address<span>*</span></label>
                    <input type="text" name="email" value="{{ old('email') }}" placeholder="Email">
                    <label for="">Password<span>*</span></label>
                    <input type="password" name="password" placeholder="Password">
                    <button type="submit" class="aa-browse-btn">Login</button>
                    <label class="rememberme" for="rememberme"><input type="checkbox" id="rememberme"> Remember me </label>
                  </form>
                </div>
            </div>
          </div> 
        </div>                    
      </div>
    </div>
  </section>

@endsection