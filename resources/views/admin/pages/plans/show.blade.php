@extends('adminlte::page')

@section('title', __("View Plan"))

@section('content_header')
    {{ Breadcrumbs::render('plansView')}}
    <h1> {{ __("View Plan") }} </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3"> <strong>{{ __("Name") }}: </strong> {{ $plan->name }}</h5>
            <p class="card-text"><strong>{{ __("Url") }}:</strong> {{ $plan->url }}</p>
            <p class="card-text"><strong>{{ __("Price") }}:</strong> {{ number_format($plan->price, 2, ',', '.') }}</p>
            <p class="card-text"><strong>{{ __("Description") }}:</strong> {{ $plan->description }}</p>
        </div>

        <div class="card-footer">
            @include('admin.includes.button_delete', [
                'pathDelete' => route('permissions.destroy', $plan->url)           
            ])
        </div>

    </div>
@stop