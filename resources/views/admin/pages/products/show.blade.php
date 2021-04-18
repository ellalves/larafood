@extends('adminlte::page')

@section('title', "Detalhes do Plano <strong>{{ $product->name }}")

@section('content_header')
    <h1> Detalhes do plano <strong>{{ $product->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <img src="{{ url("storage/$product->image") }}" alt='{{ $product->image }}' width="100">
                </li>
                <li>
                    <strong>Nome: </strong> {{ $product->name}}
                </li>
                <li>
                    <strong>Url: </strong> {{ $product->url}}
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
                    Deletar o produto <strong>({{ $product->title }})</strong>
                </button>
            </form>

        </div>
    </div>
@stop