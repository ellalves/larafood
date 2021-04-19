@extends('adminlte::page')

@section('title', 'Cadastrar Mesa')

@section('content_header')
    {{ Breadcrumbs::render('tablesCreate') }}
    <h1> Cadastrar Mesa </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tables.store') }}" method="POST" class="form">
                @include('admin.pages.tables._partials.form')
            </form>
        </div>
    </div>
@stop