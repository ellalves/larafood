@extends('adminlte::page')

@section('title', 'Cadastrar Plano')

@section('content_header')
    {{ Breadcrumbs::render('admin') }}
    <h1> Painel </h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$totalUsers}}</h3>

                    <p>Usuários</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Acessar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$totalTables}}</h3>

                    <p>Mesas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-border-all"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Acessar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-teal">
                <div class="inner">
                    <h3>{{$totalProducts}}</h3>

                    <p>Podutos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-boxes"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Acessar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{$totalCategories}}</h3>

                    <p>Categorias</p>
                </div>
                <div class="icon">
                    <i class="fas fa-archive"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Acessar <i class="fas fa-arrow-circle-right"></i>
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

                    <p>Empresas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-building"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Acessar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-light">
                <div class="inner">
                    <h3>{{$totalPlans}}</h3>

                    <p>Planos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-map"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Acessar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-indigo">
                <div class="inner">
                    <h3>{{$totalRoles}}</h3>

                    <p>Cargos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-address-book"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Acessar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$totalGroups}}</h3>

                    <p>Grupos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-layer-group"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Acessar <i class="fas fa-arrow-circle-right"></i>
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

                    <p>Permissões</p>
                </div>
                <div class="icon">
                    <i class="fas fa-lock-open"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Acessar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    @endadmin
@stop
