@extends('adminlte::page')

@section('title', __('Edit Role'))

@section('content_header')
    {{ Breadcrumbs::render('rolesEdit') }}
    <h1> {{ __('Edit Role') }} </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('roles.update', $role->id) }}" method="POST" class="form">
                @method('PUT')
                @include('admin.pages.roles._partials.form')
            </form>
        </div>
    </div>
@stop