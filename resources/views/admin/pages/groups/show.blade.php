@extends('adminlte::page')

@section('title', "Detalhes do Grupo")

@section('content_header')
    {{ Breadcrumbs::render('groupsView')}}
    <h1> Visualizar do Grupo</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $group->name}}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $group->description}}
                </li>
            </ul>
            
            @include('admin.includes.alerts')

            <form action="{{ route('groups.destroy', $group->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    Deletar o grupo ({{ $group->name }})
                </button>
            </form>

        </div>
    </div>
@stop