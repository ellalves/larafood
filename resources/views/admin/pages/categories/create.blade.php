@extends('adminlte::page')

@section('title', 'Cadastrar Categoria')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"> Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}"> Categorias</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('categories.create') }}" class="active"> Novo</a></li>
    </ol>
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