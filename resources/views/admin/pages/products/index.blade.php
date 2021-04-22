@extends('adminlte::page')

@section('title', 'Produtos Cadastrados')

@section('content_header')
    {{ Breadcrumbs::render('products') }}
    <h1>Produtos Cadastrados</h1>
@stop

@section('content')
    <div class="card">

        @include('admin.includes.alerts')

        <div class="div card-header">
            @include('admin.includes.search', [
                'route' => route('products.search'), 
                'add' => route('products.create')
            ])
        </div>

        <div class="div card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Título</th>
                        <th>Preço</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td class="align-middle">
                                <img src="{{ url("storage/$product->image") }}" alt='{{ $product->image }}' width="100" height="100">
                            </td>
                            <td class="align-middle">
                                {{ $product->title }}
                            </td>
                            <td class="align-middle">
                                R$ {{ number_format($product->price, 2, ',', '.') }}
                            </td>
                            <td class="align-middle">
                                @each('admin.includes.forms_actions', ['items' =>
                                    [
                                        'route' => route('products.categories', $product->id), 
                                        'color' => 'info',
                                        'icon' => 'archive',
                                        'label' => 'Categorias'
                                    ],
                                    [
                                        'route' => route('products.show', $product->id), 
                                        'color' => 'secondary',
                                        'icon' => 'eye',
                                        'label' => 'Ver'
                                    ],
                                    [
                                        'route' => route('products.edit', $product->id), 
                                        'color' => 'primary',
                                        'icon' => 'edit',
                                        'label' => 'Editar'
                                    ]
                                ], 'item', 'admin.includes.forms_actions')
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $products->appends($filters)->onEachSide(5)->links() !!}
            @else
                {!! $products->onEachSide(5)->links() !!}
            @endif
        </div>
    </div>
@stop