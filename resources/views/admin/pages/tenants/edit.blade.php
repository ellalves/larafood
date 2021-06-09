@extends('adminlte::page')

@section('title',  __("Editar Company"))

@section('content_header')
    {{ Breadcrumbs::render('tenantsEdit')}}
    <h1> {{ __("Editar Company") }} </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tenants.update', $tenant->id) }}" method="POST" class="form" enctype="multipart/form-data">
                @method('PUT')
                @include('admin.pages.tenants._partials.form')
            </form>
        </div>
    </div>
@stop