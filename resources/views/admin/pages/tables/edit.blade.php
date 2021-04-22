@extends('adminlte::page')

@section('title', "Editar Mesa")

@section('content_header')
    {{ Breadcrumbs::render('tablesEdit')}}
    <h1> Editar Mesa </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tables.update', $table->id) }}" method="POST" class="form">
                @method('PUT')
                @include('admin.pages.tables._partials.form')
            </form>
        </div>
    </div>
@stop