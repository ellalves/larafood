@extends('adminlte::page')

@section('title', "Categorias Disponíveis para o Produto {$product->title} ")

@section('content_header')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"> Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}"> Produtos </a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.categories', $product->id) }}"> Categorias</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.categories.available', $product->id) }}" class="active"> Disponíveis</a></li>
    </ol>
    <h1>Categorias Disponíveis para o Produto <strong>{{$product->title}}</strong> <a href="{{ route('products.categories.available', $product->id) }}" class="btn btn-success"> <i class="fas fa-plus-square"></i> NOVO </a> </h1>
@stop

@section('content')
    <div class="card">

        @include('admin.includes.alerts')

        <div class="div card-header">
            <form action="{{ route('categories.search') }}" method="post" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Filtrar" value="{{ $filters['filter'] ?? '' }}" class="form-control">
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>
        <div class="div card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>
                                <a href="{{ route('products.categories.detach', [$product->id, $category->id] ) }}" class="btn btn-danger">
                                    <i class="fas fa-unlink"></i> Desvincular
                                </a>
                             </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $categories->appends($filters)->onEachSide(5)->links() !!}
            @else
                {!! $categories->onEachSide(5)->links() !!}
            @endif
        </div>
    </div>
@stop