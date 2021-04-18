@extends('adminlte::page')

@section('title', "Visualizar Permissão")

@section('content_header')
    <h1> Visualizar Permissão</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $permission->name}}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $permission->description}}
                </li>
            </ul>
            
            @include('admin.includes.alerts')

            <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    Deletar a permissão ({{ $permission->name }})
                </button>
            </form>

        </div>
    </div>
@stop