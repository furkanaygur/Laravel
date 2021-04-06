<header id="aa-header">
  <!-- start header top  -->
  <div class="aa-header-top">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-header-top-area">
            <div class="aa-header-top-right">
              <ul style="display: flex" class="aa-head-top-nav-right">
                @guest
                <a style="border: 1px solid #37c6f5; margin:5px 10px 5px 0; font-size:14px;" class="aa-secondary-btn" href="{{ route('user.login.form') }}">Register now!</a>
                <a style="border: 1px solid #37c6f5; margin:5px 0; font-size:14px;" class="aa-secondary-btn" href="" data-toggle="modal" data-target="#login-modal">Login</a>
                @endguest
                @auth              
                  <a href="{{ route('order') }}" style="border: 1px solid #37c6f5; margin:5px 0; font-size:14px;" class="aa-secondary-btn">Orders</a> 
                  <form style="margin-left:1.25rem;" action="{{ route('user.logout') }}" method="POST">
                    {{ csrf_field() }}
                    <button style="border: 1px solid #37c6f5; margin:5px 0; font-size:14px;" class="aa-secondary-btn">Logout</button>
                  </form>
                @endauth
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- / header top  -->

  <!-- start header bottom  -->
  <div class="aa-header-bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-header-bottom-area">
            <!-- logo  -->
            <div class="aa-logo">
              <!-- Text based logo -->
              <a href="{{ route('user.index') }}">
                <span class="fa fa-shopping-cart"></span>
                <p>daily<strong>Shop</strong> <span>Your Shopping Partner</span></p>
              </a>
            </div>
            <!-- / logo  -->
             <!-- cart box -->
            <div class="aa-cartbox">
              <a class="aa-cart-link" href="{{ route('cart') }}">
                <span class="fa fa-shopping-basket"></span>
                <span class="aa-cart-title">SHOPPING CART</span>
                <span class="aa-cart-notify">{{ Cart::count() }}</span>
              </a>
            </div>
            <!-- / cart box -->
            <!-- search box -->
            <div class="aa-search-box">
              <form action="">
                <input type="text" name="" id="" placeholder="Search">
                <button type="submit"><span class="fa fa-search"></span></button>
              </form>
            </div>
            <!-- / search box -->             
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- / header bottom  -->
</header>

<!-- menu -->
<section id="menu">
  <div class="container">
    <div class="menu-area">
      <!-- Navbar -->
      <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>          
        </div>
        <div class="navbar-collapse collapse">
          <!-- Left nav -->
          <ul class="nav navbar-nav">
            <li><a href="{{ route('user.index') }}">Home</a></li>
            <li><a href="#">Categories<span class="caret"></span></a>
              <ul class="dropdown-menu">     
                @foreach ($setting['category'] as $category)
                <li><a href="{{ route('category', $category->slug) }}">{{ $category->name }}</a></li>
                @endforeach           
                
                {{-- <li><a href="#">And more.. <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Page2</a></li>                                     
                  </ul>
                </li> --}}
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>       
  </div>
</section>
<!-- / menu -->

  <!-- Login Modal -->  
  <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">                      
        <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4>Login or Register</h4>
          <form class="aa-login-form" action="{{ route('user.login') }}" method="POST">
            {{ csrf_field() }}
            <label for="">Username or Email address<span>*</span></label>
            <input type="text" name="email" placeholder="Username or email">
            <label for="">Password<span>*</span></label>
            <input type="password" name="password" placeholder="Password">
            <button class="aa-browse-btn" type="submit">Login</button>
            <label for="rememberme" class="rememberme"><input type="checkbox" name="rememberme" id="rememberme"> Remember me </label>
            <div class="aa-register-now">
              Don't have an account?<a href="{{ route('user.login.form') }}">Register now!</a>
            </div>
          </form>
        </div>                        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>   