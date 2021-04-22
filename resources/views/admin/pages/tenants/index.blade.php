@extends('adminlte::page')

@section('title', 'Empresas Cadastradas')

@section('content_header')
    {{ Breadcrumbs::render('tenants') }}
    <h1>Empresas Cadastradas</h1>
@stop

@section('content')
    <div class="card">

        @include('admin.includes.alerts')

        <div class="div card-header">
            @include('admin.includes.search', [
                'route' => route('tenants.search'), 
                'add' => route('tenants.create')
            ])
        </div>

        <div class="div card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Nome</th>
                        <th>Documento</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tenants as $tenant)
                        <tr>
                            <td class="align-middle">
                                <img src="{{ url("storage/$tenant->logo") }}" alt='{{ $tenant->logo }}' width="100" height="100">
                            </td>
                            <td class="align-middle">
                                {{ $tenant->name }}
                            </td>
                            <td class="align-middle">
                                {{ $tenant->document }}
                            </td>
                            <td class="align-middle">
                                @each('admin.includes.forms_actions', ['items' =>
                                    // [
                                    //     'route' => route('tenants.categories', $tenant->id), 
                                    //     'color' => 'info',
                                    //     'icon' => 'archive',
                                    //     'label' => 'Categorias'
                                    // ],
                                    [
                                        'route' => route('tenants.show', $tenant->id), 
                                        'color' => 'secondary',
                                        'icon' => 'eye',
                                        'label' => 'Ver'
                                    ],
                                    [
                                        'route' => route('tenants.edit', $tenant->id), 
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
                {!! $tenants->appends($filters)->onEachSide(5)->links() !!}
            @else
                {!! $tenants->onEachSide(5)->links() !!}
            @endif
        </div>
    </div>
@stop