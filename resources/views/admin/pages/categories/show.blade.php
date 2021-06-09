@extends('adminlte::page')

@section('title', __("View Category"))

    @section('content_header')
    {{ Breadcrumbs::render('categoriesView')}}
    <h1> {{ __("View Category") }} </h1>
@stop

@section('content')
    <div class="card">

        <div class="card-body">
            <h5 class="card-title mb-3"> <strong>{{ __("Name") }}: </strong> {{ $category->name }}</h5>
            <p class="card-text"><strong>{{ __("Description") }}:</strong> {{ $category->description }}</p>
        </div>

        <div class="card-footer">
            @include('admin.includes.button_delete', [
                'pathDelete' => route('categories.destroy', $category->id)          
            ])
        </div>
    </div>
@stop