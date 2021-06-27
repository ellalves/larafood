@extends('adminlte::page')

@section('title', __("Control Panel"))

@section('content_header')
    {{ Breadcrumbs::render('admin') }}
    <h1> {{__("Control Panel")}} </h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$totalUsers}}</h3>

                    <p>{{__("Users")}}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{route('users.index')}}" class="small-box-footer">
                    {{__("Access")}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$totalTables}}</h3>

                    <p>{{__("Table")}}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-border-all"></i>
                </div>
                <a href="{{route('tables.index')}}" class="small-box-footer">
                    {{__("Access")}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-teal">
                <div class="inner">
                    <h3>{{$totalProducts}}</h3>

                    <p>{{__("Products")}}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-boxes"></i>
                </div>
                <a href="{{route('products.index')}}" class="small-box-footer">
                    {{__("Access")}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{$totalCategories}}</h3>

                    <p>{{__("Categories")}}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-archive"></i>
                </div>
                <a href="{{route('categories.index')}}" class="small-box-footer">
                    {{__("Access")}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
    </div>

    @admin
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{$totalTenants}}</h3>

                    <p>{{__("Companies")}}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-building"></i>
                </div>
                <a href="{{route('tenants.index')}}" class="small-box-footer">
                    {{__("Access")}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-light">
                <div class="inner">
                    <h3>{{$totalPlans}}</h3>

                    <p>{{__("Plans")}}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-map"></i>
                </div>
                <a href="{{route('plans.index')}}" class="small-box-footer">
                    {{__("Access")}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-indigo">
                <div class="inner">
                    <h3>{{$totalRoles}}</h3>

                    <p>{{__("Roles")}}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-address-book"></i>
                </div>
                <a href="{{route('roles.index')}}" class="small-box-footer">
                    {{__("Access")}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$totalGroups}}</h3>

                    <p>{{__("Groups")}}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-layer-group"></i>
                </div>
                <a href="{{route('groups.index')}}" class="small-box-footer">
                    {{__("Access")}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    @endadmin

    @admin
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
                <div class="inner">
                    <h3>{{$totalPermissions}}</h3>

                    <p>{{__("Permissions")}}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-lock-open"></i>
                </div>
                <a href="{{route('permissions.index')}}" class="small-box-footer">
                    {{__("Access")}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    @endadmin
@stop
