@extends('adminlte::page')

@section('title', __("View Role"))

@section('content_header')
    {{ Breadcrumbs::render('rolesView')}}
    <h1> {{ __("View Role") }} </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3"> <strong>{{ __("Name") }}: </strong> {{ $role->name }}</h5>
            <p class="card-text"><strong>{{ __("Description") }}:</strong> {{ $role->description }}</p>
        </div>
    
        <div class="card-footer">
            @include('admin.includes.button_delete', [
                'pathDelete' => route('roles.destroy', $role->id)           
            ])
        </div>

    </div>
@stop