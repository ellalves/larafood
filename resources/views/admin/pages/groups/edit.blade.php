@extends('adminlte::page')

@section('title', "Editar o Grupo: $group->name")

@section('content_header')
    {{ Breadcrumbs::render('categoriesEdit') }}
    <h1> Editar o Grupo:  <strong>{{ $group->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('groups.update', $group->id) }}" method="POST" class="form">
                @method('PUT')
                @include('admin.pages.groups._partials.form')
            </form>
        </div>
    </div>
@stop