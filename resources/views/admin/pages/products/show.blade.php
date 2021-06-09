@extends('adminlte::page')

@section('title', "Visualizar Produto")

@section('content_header')
    {{ Breadcrumbs::render('productsView', $product)}}
    <h1> Visualizar Produto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul class="products-list product-list-in-card pl-2 pr-2">
                <li class="item">
                    <div class="product-img">
                        <img src="{{ !empty($product->image) ? url("storage/$product->image") : url("images/company_none.png") }}" alt='{{ $product->image }}' width="img-size-250">
                    </div>
                    <div class="product-info">
                        <a href="{{ route('products.edit', $product->id) }}" class="product-title"> {{ $product->title }}
                            <span class="badge badge-light float-right">
                                R$ {{ $product->price_br }}
                            </span>
                        </a>
                        <span class="product-description">
                            {{ $product->description }}
                        </span>
                    </div>
                </li>
                <li>
                    <strong> {{ __("UUID") }}: </strong> {{ $product->uuid}}
                </li>
                <li>
                    <strong> {{ __("Created At") }}: </strong> {{ $product->created }}
                </li>
                <li>
                    <strong> {{ __("Updated At") }}: </strong> {{ $product->updated}}
                </li>
            </ul>

        </div>

        <div class="card-footer">
            @include('admin.includes.button_delete', [
                'pathDelete' => route('products.destroy', $product->id)
            ])
        </div>
    </div>
@stop