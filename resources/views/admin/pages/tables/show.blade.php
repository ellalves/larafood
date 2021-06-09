@extends('adminlte::page')

@section('title',  __("View Table"))

@section('content_header')
    {{ Breadcrumbs::render('tablesView')}}
    <h1> {{ __("View Table") }} </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card-body">
                <h5 class="card-title mb-3"> <strong>{{ __("Name") }}: </strong> {{ $table->name }}</h5>
                <p class="card-text"><strong>{{ __("Description") }}:</strong> {{ $table->description }}</p>
            </div>
    
            <div class="card-footer">
                @include('admin.includes.button_delete', [
                    'pathDelete' => route('tables.destroy', $table->id)          
                ])
            </div>

        </div>
    </div>
@stop