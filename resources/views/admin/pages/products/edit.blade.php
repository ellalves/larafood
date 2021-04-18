@extends('adminlte::page')

@section('title', "Editar Produto")

@section('content_header')
    {{ Breadcrumbs::render('productsEdit')}}
    <h1> Editar Produto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" method="POST" class="form" enctype="multipart/form-data">
                @method('PUT')
                @include('admin.pages.products._partials.form')
            </form>
        </div>
    </div>
@stop