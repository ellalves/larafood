@extends('adminlte::page')

@section('title', __("Register Category"))

@section('content_header')
    {{ Breadcrumbs::render('categoriesCreate') }}
    <h1> {{ __("Register Category") }} </h1>
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