@extends('adminlte::page')

@section('title', "Editar o usuário: $user->name ")

@section('content_header')
    {{ Breadcrumbs::render('usersEdit')}}
    <h1> Editar o usuário </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST" class="form">
                @method('PUT')
                @include('admin.pages.users._partials.form')
            </form>
        </div>
    </div>
@stop