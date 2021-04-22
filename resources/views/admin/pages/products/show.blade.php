@extends('adminlte::page')

@section('title', "Visualizar Produto")

@section('content_header')
    {{ Breadcrumbs::render('productsView', $product)}}
    <h1> Visualizar Produto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <img src="{{ url("storage/$product->image") }}" alt='{{ $product->image }}' width="100">
                </li>
                <li>
                    <strong>Nome: </strong> {{ $product->title}}
                </li>
                <li>
                    <strong>Price: </strong> {{ number_format($product->price, 2, ',', '.') }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $product->description}}
                </li>
            </ul>
            
            @include('admin.includes.alerts')

            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    Deletar o produto
                </button>
            </form>

        </div>
    </div>
@stop