@extends('adminlte::page')

@section('title', __("Register Product"))

@section('content_header')
    {{ Breadcrumbs::render('productsCreate') }}
    <h1> {{ __("Register Product") }} </h1>
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