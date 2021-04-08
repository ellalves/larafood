@extends('adminlte::page')

@section('title', "Visualizar o usuário <strong>{{ $user->name }}")

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"> Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('users.show', $user->id) }}" class="active"> Visualizar</a></li>
</ol>
<h1> Visualizar o usuário {{ $user->name }} </h1>
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