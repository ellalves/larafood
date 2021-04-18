@extends('adminlte::page')

@section('title', "Editar a Permissão: $permission->name")

@section('content_header')
    {{ Breadcrumbs::render('permissionsEdit')}}
    <h1> Editar Permissão</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('permissions.update', $permission->id) }}" method="POST" class="form">
                @method('PUT')
                @include('admin.pages.permissions._partials.form')
            </form>
        </div>
    </div>
@stop