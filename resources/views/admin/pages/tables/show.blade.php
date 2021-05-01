@extends('adminlte::page')

@section('title', "Visualizar Mesa")

@section('content_header')
    {{ Breadcrumbs::render('tablesView')}}
    <h1> Visualizar Mesa </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $table->name }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $table->description }}
                </li>
            </ul>
            
            @include('admin.includes.alerts')

            <form action="{{ route('tables.destroy', $table->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    Deletar a mesa
                </button>
            </form>

        </div>
    </div>
@stop