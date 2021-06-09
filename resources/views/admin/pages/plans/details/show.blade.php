@extends('adminlte::page')

@section('title', __("View Detail"))

@section('content_header')
    {{ Breadcrumbs::render('PlansDetailsCreate', $plan)}}
    <h1> {{ __("View Detail") }} </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3"> <strong>{{ __("Name") }}: </strong> {{ $detail->name }}
        </div>

        <div class="card-footer">
            @include('admin.includes.button_delete', [
                'pathDelete' => route('permissions.destroy', $plan->url)           
            ])
        </div>
    </div>
@stop