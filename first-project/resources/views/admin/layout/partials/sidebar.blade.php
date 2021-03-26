<div class="list-group">
    <a href="{{ route('admin.index') }}" class="list-group-item">
        <span class="fa fa-fw fa-dashboard"></span> Dashboard</a>
    <a href="{{ route('admin.products') }}" class="list-group-item">
        <span class="fa fa-fw fa-cubes"></span> Products
        <span class="badge badge-dark badge-pill pull-right">{{ $statistics['products'] }}</span>
    </a>
    {{-- <a href="{{ route('admin.categories') }}" class="list-group-item collapsed" data-target="#submenu1" data-toggle="collapse" data-parent="#sidebar"><span class="fa fa-fw fa-dashboard"></span> Categories<span class="caret arrow"></span></a>
    <div style="margin-bottom: 0" class="list-group collapse" id="submenu1">
        <a href="#" class="list-group-item">Category</a>
        <a href="#" class="list-group-item">Category</a>
    </div> --}}
    <a href="{{ route('admin.categories') }}" class="list-group-item">
        <span class="fa fa-fw fa-cubes"></span> Categories
        <span class="badge badge-dark badge-pill pull-right">{{ $statistics["categories"] }}</span>
    </a>
    <a href="{{ route('admin.users') }}" class="list-group-item">
        <span class="fa fas fa-users"></span> Users
        <span class="badge badge-dark badge-pill pull-right">{{ $statistics["users"] }}</span>
    </a>
    <a href="{{ route('admin.orders') }}" class="list-group-item">
        <span class="fa fa-fw fa-shopping-cart"></span> Orders
        <span class="badge badge-dark badge-pill pull-right">{{ $statistics['orders'] }}</span>
    </a>
</div>