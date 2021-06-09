@extends('adminlte::page')

@section('title',  __("Register Table"))

@section('content_header')
    {{ Breadcrumbs::render('tablesCreate') }}
    <h1> {{ __("Register Table") }} </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tables.store') }}" method="POST" class="form">
                @include('admin.pages.tables._partials.form')
            </form>
        </div>
    </div>
@stop