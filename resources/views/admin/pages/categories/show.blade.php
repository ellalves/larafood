@extends('adminlte::page')

@section('title', "Visualizar Categoria")

    @section('content_header')
    {{ Breadcrumbs::render('cartegoriesView')}}
    <h1> Visualizar Categoria </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $category->name}}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $category->description}}
                </li>
            </ul>
            
            @include('admin.includes.alerts')

            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    Deletar a categoria ({{ $category->name }})
                </button>
            </form>

        </div>
    </div>
@stop