@extends('adminlte::page')

@section('title', "Categorias do Produto {{ $product->title }} ")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"> Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('categories.index') }}" class="active"> Categorias</a></li>
    </ol>
    <h1>Categorias do Produto <strong>{{ $product->title }}</strong>
@stop

@section('content')
    <div class="card">

        @include('admin.includes.alerts')

        <div class="div card-header">
            <form action="{{ route('products.categories.attach', $product->id) }}" method="post" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Nome" value="{{ $filters['filter'] ?? '' }}" class="form-control">
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>
        <div class="div card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th width="50px">#</th>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('products.categories.attach', $product->id)}}" method="post">
                        @csrf

                        @foreach($categories as $category) 
                            <tr>
                                <td><input id="{{ $category->id }}" type="checkbox" name="categories[]" value="{{ $category->id }}"></td>
                                <td><label for="{{ $category->id }}">{{ $category->name }}</label></td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="500">
                                <button type="submit" class="btn btn-dark">Vincular</button>
                            </td>
                        </tr>                      
                    </form>
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