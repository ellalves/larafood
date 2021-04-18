@extends('adminlte::page')

@section('title', 'Cadastrar Produto')

@section('content_header')
    {{ Breadcrumbs::render('productsCreate') }}
    <h1> Cadastrar Produto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST" class="form" enctype="multipart/form-data">
                @include('admin.pages.products._partials.form')
            </form>
        </div>
    </div>
@stop