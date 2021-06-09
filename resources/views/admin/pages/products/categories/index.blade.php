@extends('adminlte::page')

@section('title', __("Product Categories") . ': ' . $product->title)

@section('content_header')
    {{ Breadcrumbs::render('productsCategories', $product) }}
    <h1> {{ __("Product Categories") }}: <strong>{{$product->title}}</strong> </h1>
@stop

@section('content')
    <div class="card">

        <div class="div card-header">
            @include('admin.includes.search', [
                'route' => null,
                'add' => route('products.categories.available', $product->id),
                'label' => __('Link'),
                'icon' => 'link'
            ])
        </div>

        <div class="div card-body table-responsive">

            @include('admin.includes.alerts')

            <table class="table table-condensed table-dark table-striped table-hover table-borderless align-middle">
                <thead>
                    <tr>
                        <th scope="col">{{ __('Name') }}</th>
                        <th scope="col" class="float-right mr-4">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td class="align-middle">{{ $category->name }}</td>
                            <td class="align-middle float-right">
                                @each('admin.includes.forms_actions', ['items' =>                               
                                    [
                                        'route' => route('products.categories.detach', [$product->id, $category->id] ), 
                                        'color' => 'danger',
                                        'icon' => 'unlink',
                                        'label' => __('Unlink')
                                    ]
                                ], 'item')                                
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="500">
                                @include('admin.includes.alerts_messages', ['msg' => __('messages.no_link_yet') ])
                            </td>
                        </tr>
                    @endforelse
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