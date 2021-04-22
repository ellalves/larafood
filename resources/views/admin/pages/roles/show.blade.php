@extends('adminlte::page')

@section('title', "Detalhes do Cargo")

@section('content_header')
    {{ Breadcrumbs::render('rolesView')}}
    <h1> Visualizar do Cargo</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $role->name}}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $role->description}}
                </li>
            </ul>
            
            @include('admin.includes.alerts')

            <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    Deletar o cargo
                </button>
            </form>

        </div>
    </div>
@stop