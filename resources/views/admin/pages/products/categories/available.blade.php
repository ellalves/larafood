@extends('adminlte::page')

@section('title', "Categorias do Produto {{ $product->title }} ")

@section('content_header')
    {{ Breadcrumbs::render('productsCategoriesAvailable', $product) }}
    <h1>Categorias do Produto <strong>{{ $product->title }}</strong>
@stop

@section('content')
    <div class="card">

        @include('admin.includes.alerts')

        <div class="div card-header">
            @include('admin.includes.search', [
                'route' => route('products.categories.available', $product->id)
            ])
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
                                @if (count($categories) > 0)
                                    <button type="submit" class="btn btn-dark">
                                        <i class="fas fa-link"></i> Vincular
                                    </button>
                                @else
                                    @include('admin.includes.alerts_messages', ['msg' => __('messages.no_options_available') ])
                                @endif
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