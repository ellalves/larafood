@extends('adminlte::page')

@section('title', __('Registered Products'))

@section('content_header')
    {{ Breadcrumbs::render('products') }}
    <h1> {{ __('Registered Products') }} </h1>
@stop

@section('content')
    <div class="card">

        <div class="div card-header px-4">
            @include('admin.includes.search', [
                'route' => route('products.search'), 
                'add' => route('products.create')
            ])
        </div>

        <div class="div card-body table-responsive">

            @include('admin.includes.alerts')

            <table class="table table-condensed table-dark table-striped table-hover table-borderless align-middle">
                <thead>
                    <tr>
                        <th scope="col">{{ __('Image') }}</th>
                        <th scope="col">{{ __('Title') }}</th>
                        <th scope="col">{{ __('Price') }}</th>
                        <th scope="col" class="float-right mr-4">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td class="align-middle">
                                <img src="{{ !empty($product->image) ? url("storage/$product->image") : url("images/company_none.png") }}" 
                                    alt='{{ $product->image }}' 
                                    width="100" 
                                    height="100"
                                    class="img-fluid"
                                >
                            </td>
                            <td class="align-middle">
                                {{ $product->title }}
                            </td>
                            <td class="align-middle">
                                R$ {{ number_format($product->price, 2, ',', '.') }}
                            </td>
                            <td class="align-middle float-right">
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