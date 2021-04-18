@extends('adminlte::page')

@section('title', 'Cadastrar Categoria')

@section('content_header')
    {{ Breadcrumbs::render('categoriesCreate') }}
    <h1> Cadastrar Categoria </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="POST" class="form">
                @include('admin.pages.categories._partials.form')
            </form>
        </div>
    </div>
@stop