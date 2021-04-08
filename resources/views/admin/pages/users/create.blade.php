@extends('adminlte::page')

@section('title', 'Cadastrar Usuário')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"> Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('users.create') }}" class="active"> Novo</a></li>
    </ol>
    <h1> Cadastrar Usuário </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="POST" class="form">
                @include('admin.pages.users._partials.form')
            </form>
        </div>
    </div>
@stop