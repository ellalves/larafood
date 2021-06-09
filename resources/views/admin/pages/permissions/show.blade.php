@extends('adminlte::page')

@section('title', __("View Permission"))

@section('content_header')
{{ Breadcrumbs::render('permissionsView')}}
    <h1> {{ __("View Permission") }} </h1>
@stop

@section('content')
    <div class="card">

        <div class="card-body">
            <h5 class="card-title mb-3"> <strong>{{ __("Name") }}: </strong> {{ $permission->name }}</h5>
            <p class="card-text"><strong>{{ __("Description") }}:</strong> {{ $permission->description }}</p>
        </div>

        <div class="card-footer">
            @include('admin.includes.button_delete', [
                'pathDelete' => route('permissions.destroy', $permission->id)           
            ])
        </div>

    </div>
@stop