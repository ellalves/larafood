@extends('adminlte::page')

@section('title', 'Categorias Cadastradas')

@section('content_header')
    {{ Breadcrumbs::render('tables') }}
    <h1>Categorias Cadastradas</h1>
@stop

@section('content')
    <div class="card">

        @include('admin.includes.alerts')

        <div class="div card-header">
            @include('admin.includes.search', [
                'route' => route('tables.search'), 
                'add' => route('tables.create')
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
                    @foreach($tables as $table)
                        <tr>
                            <td>{{ $table->name }}</td>
                            <td class="align-middle">
                                @each('admin.includes.forms_actions', ['items' => 
                                [
                                    'route' => route('tables.show', $table->id), 
                                    'color' => 'secondary',
                                    'icon' => 'eye',
                                    'label' => 'Ver'
                                ],
                                [
                                    'route' => route('tables.edit', $table->id), 
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
                {!! $tables->appends($filters)->onEachSide(5)->links() !!}
            @else
                {!! $tables->onEachSide(5)->links() !!}
            @endif
        </div>
    </div>
@stop