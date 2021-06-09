@extends('adminlte::page')

@section('title', __('View Group'))

@section('content_header')
    {{ Breadcrumbs::render('groupsView') }}
    <h1> {{ __('View Group') }}</h1>
@stop

@section('content')
    <div class="card">

        <div class="card-body">
            <h5 class="card-title mb-3"> <strong>{{ __("Name") }}: </strong> {{ $group->name }}</h5>
            <p class="card-text"><strong>{{ __("Description") }}:</strong> {{ $group->description }}</p>
        </div>

        <div class="card-footer">
            @include('admin.includes.button_delete', [
                'pathDelete' => route('groups.destroy', $group->id)           
            ])
        </div>
    </div>
@stop
