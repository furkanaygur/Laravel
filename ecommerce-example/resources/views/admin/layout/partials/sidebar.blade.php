 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.index') }}" class="brand-link">
      <span class="brand-text font-weight-light">Furkan AYGUR</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-header">Pages</li>
          <li class="nav-item">
            <a href="{{ route('admin.users') }}" class="nav-link {{ (request()->is('admin/users')) ||request()->is('admin/user/*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.products') }}" class="nav-link {{ (request()->is('admin/products')) ||request()->is('admin/product/*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-box-open"></i>
              <p>
                Products
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.categories') }}" class="nav-link {{ (request()->is('admin/categories')) ||request()->is('admin/category/*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Categories
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.orders') }}" class="nav-link {{ (request()->is('admin/orders')) ||request()->is('admin/order/*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-cart-arrow-down"></i>
              <p>
                Orders
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>