@extends('adminlte::page')

@section('title', 'Cadastrar Grupo')

@section('content_header')
    {{ Breadcrumbs::render('groupsCreate') }}
    <h1> Cadastrar Grupo </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('groups.store') }}" method="POST" class="form">
                @include('admin.pages.groups._partials.form')
            </form>
        </div>
    </div>
@stop