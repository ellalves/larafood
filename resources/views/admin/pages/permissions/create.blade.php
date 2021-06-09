@extends('adminlte::page')

@section('title', __('Register Permission'))

@section('content_header')
    {{ Breadcrumbs::render('permissionsCreate') }}
    <h1> {{ __('Register Permission') }} </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('permissions.store') }}" method="POST" class="form">
                @include('admin.pages.permissions._partials.form')
            </form>
        </div>
    </div>
@stop