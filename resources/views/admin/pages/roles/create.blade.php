@extends('adminlte::page')

@section('title', 'Cadastrar Cargo')

@section('content_header')
    {{ Breadcrumbs::render('rolesCreate') }}
    <h1> Cadastrar Cargo </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('roles.store') }}" method="POST" class="form">
                @include('admin.pages.roles._partials.form')
            </form>
        </div>
    </div>
@stop