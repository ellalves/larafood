@extends('adminlte::page')

@section('title', "Categorias do Produto {$product->title} ")

@section('content_header')
    {{ Breadcrumbs::render('productsCategories', $product) }}
    <h1>Categorias do Produto <strong>{{$product->title}}</strong> </h1>
@stop

@section('content')
    <div class="card">

        @include('admin.includes.alerts')
        
        <div class="div card-header">
            @include('admin.includes.search', [
                'route' => null,
                'add' => route('products.categories.available', $product->id),
                'label' => 'VINCULAR',
                'icon' => 'link'
            ])
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
                    @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>
                                <a href="{{ route('products.categories.detach', [$product->id, $category->id] ) }}" class="btn btn-danger">
                                    <i class="fas fa-unlink"></i> Desvincular
                                </a>
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