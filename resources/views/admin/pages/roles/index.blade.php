@extends('adminlte::page')

@section('title', 'Cargos Cadastrados')

@section('content_header')
    {{ Breadcrumbs::render('roles') }}
    <h1>Cargos Cadastrados</h1>
@stop

@section('content')
    <div class="card">
        @include('admin.includes.alerts')

        <div class="div card-header">
            @include('admin.includes.search', [
                'route' => route('roles.search'),
                'add' => route('roles.create')
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
                    @forelse($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>
                                @each('admin.includes.forms_actions', ['items' =>                               
                                    [
                                        'route' => route('roles.permissions', $role->id), 
                                        'color' => 'dark',
                                        'icon' => 'lock',
                                        'label' => 'Permissões'
                                    ],
                                    [
                                        'route' => route('roles.show', $role->id), 
                                        'color' => 'secondary',
                                        'icon' => 'eye',
                                        'label' => 'Ver'
                                    ],
                                    [
                                        'route' => route('roles.edit', $role->id), 
                                        'color' => 'primary',
                                        'icon' => 'edit',
                                        'label' => 'Editar'
                                    ]
                                ], 'item')
                            </td>
                        </tr>
                    @empty
                    @include('admin.includes.alerts_messages', ['msg' => __('messages.empty_register') ])
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $roles->appends($filters)->onEachSide(5)->links() !!}
            @else
                {!! $roles->onEachSide(5)->links() !!}
            @endif
        </div>
    </div>
@stop