@extends('adminlte::page')

@section('title', 'Cadastrar Empresa')

@section('content_header')
    {{ Breadcrumbs::render('tenantsCreate') }}
    <h1> Cadastrar Empresa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tenants.store') }}" method="POST" class="form" enctype="multipart/form-data">
                @include('admin.pages.tenants._partials.form')
            </form>
        </div>
    </div>
@stop
