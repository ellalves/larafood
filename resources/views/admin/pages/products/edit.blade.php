@extends('adminlte::page')

@section('title', __("Edit Product"))

@section('content_header')
    {{ Breadcrumbs::render('productsEdit')}}
    <h1> {{ __("Edit Product") }} </h1>
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