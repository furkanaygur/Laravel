@extends('admin.layout.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ count($setting['user']) }}</h3>
                <p>Total Users</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="{{ route('admin.users') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ count($setting['order']) }}</h3>
                <p>Total Orders</p>
              </div>
              <div class="icon">
                <i class="fas fa-shopping-cart"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div style="color: #fff !important;" class="small-box bg-warning">
              <div class="inner">
                <h3>{{ count($setting['product']) }}</h3>
                <p>Total Products</p>
              </div>
              <div class="icon">
                <i class="fas fa-box-open"></i>
              </div>
              <a href="#" style="color: #fff !important;" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ count($setting['category']) }}</h3>
                <p>Total Categories</p>
              </div>
              <div class="icon">
                <i class="fas fa-th"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-md-8">
            <!-- MAP & BOX PANE -->
            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Latest Orders</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Piece</th>
                      <th>Price</th>
                      <th>Status</th>
                      <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($orders as $order)
                      <tr>
                        <td><a href="#">SP-{{ $order->id }}</a></td>
                        <td>{{ $order->cart->product_piece() }}</td>
                        <td>${{ $order->price }}</td>
                        <td><span class="badge badge-warning">{{ $order->statu }}</span></td>
                        <td><a href="#" class="btn btn-sm btn-success">Order Detail</a></td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="javascript:void(0)" class="btn btn-sm btn-primary float-right">View All Orders</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
        
          <div class="col-md-4">
            <!-- USERS LIST -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Latest Members</h3>

                <div class="card-tools">
                  <span class="badge badge-danger">{{ count($users) }} New Members</span>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="users-list clearfix">
                  @foreach ($users as $user )
                    <li>
                      <img src="/img/50x50.png" alt="User Image">
                      <a class="users-list-name" href="#">{{ $user->name . ' ' . $user->surname }}</a>
                      <span class="users-list-date">{{ timeConvert($user->created_at) }}</span>
                    </li>
                  @endforeach
                </ul>
                <!-- /.users-list -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="javascript:">View All Users</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!--/.card -->
          </div>
          <!-- /.col -->
        </div>

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
            <!-- /.col -->
            <div class="col-md-12">
              <!-- PRODUCT LIST -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Recently Added Products</h3>
  
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <ul class="products-list product-list-in-card pl-2 pr-2">
                   @foreach ($products as $product)
                    <li class="item">
                      <div class="product-img">
                        <img src="/img/250x300.png" alt="Product Image" class="img-size-50">
                      </div>
                      <div class="product-info">
                        <a href="{{ route('category.product', [$product->categories[0]->slug, $product->slug]) }}" target="_blank" class="product-title">{{ $product->title }}
                          <span class="badge badge-info float-right">${{ $product->price }}</span></a>
                        <span class="product-description">
                          {{ \Illuminate\Support\Str::limit($product->description, 125, $end='...') }}
                        </span>
                        <a href="" class="btn btn-sm btn-success float-right">Product Detail</a>
                      </div>
                    </li>
                    <!-- /.item -->
                   @endforeach
                  </ul>
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                  <a href="javascript:void(0)" class="uppercase">View All Products</a>
                </div>
                <!-- /.card-footer -->
              </div>
              <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->

@endsection