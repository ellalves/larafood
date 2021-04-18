@extends('adminlte::page')

@section('title', 'Cadastrar Usuário')

@section('content_header')
    {{ Breadcrumbs::render('usersCreate') }}
    <h1> Cadastrar Usuário  </h1>
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