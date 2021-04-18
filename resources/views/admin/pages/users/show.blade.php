@extends('adminlte::page')

@section('title', "Visualizar o usuário")

@section('content_header')
    {{ Breadcrumbs::render('usersView')}}
    <h1> Visualizar o usuário</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $user->name}}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $user->description}}
                </li>
            </ul>
            
            @include('admin.includes.alerts')

            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    Deletar o Usuário <strong>({{ $user->name }})</strong>
                </button>
            </form>

        </div>
    </div>
@stop