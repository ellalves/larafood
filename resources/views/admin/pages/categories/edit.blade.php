@extends('adminlte::page')

@section('title', __("Edit Category") . $category->name)

@section('content_header')
    {{ Breadcrumbs::render('categoriesEdit')}}
    <h1> {{ __("Edit Category")  }} <strong>{{ $category->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('categories.update', $category->id) }}" method="POST" class="form">
                @method('PUT')
                @include('admin.pages.categories._partials.form')
            </form>
        </div>
    </div>
@stop