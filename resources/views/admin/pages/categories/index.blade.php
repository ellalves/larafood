@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
    {{ Breadcrumbs::render('categories') }}
    <h1>Categorias</h1>
@stop

@section('content')
    <div class="card">

        @include('admin.includes.alerts')

        <div class="div card-header">
            @include('admin.includes.search', [
                'route' => route('categories.search'), 
                'add' => route('categories.create')
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
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td class="align-middle">
                                @each('admin.includes.forms_actions', ['items' => 
                                [
                                    'route' => route('categories.show', $category->id), 
                                    'color' => 'secondary',
                                    'icon' => 'eye',
                                    'label' => 'Ver'
                                ],
                                [
                                    'route' => route('categories.edit', $category->id), 
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
                {!! $categories->appends($filters)->onEachSide(5)->links() !!}
            @else
                {!! $categories->onEachSide(5)->links() !!}
            @endif
        </div>
    </div>
@stop