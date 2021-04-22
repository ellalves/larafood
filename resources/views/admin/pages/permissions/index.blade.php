@extends('adminlte::page')

@section('title', 'Permissões Cadastradas')

@section('content_header')
    {{ Breadcrumbs::render('permissions') }}
    <h1>Permissões Cadastradas</h1>
@stop

@section('content')
    <div class="card">

        @include('admin.includes.alerts')

        <div class="div card-header">
            @include('admin.includes.search', [
                'route' => route('permissions.search'), 
                'add' => route('permissions.create')
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
                    @forelse($permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>
                                @each('admin.includes.forms_actions', ['items' => 
                                    [
                                        'route' => route('permissions.roles', $permission->id ), 
                                        'color' => 'info',
                                        'icon' => 'address-book',
                                        'label' => 'Cargos'
                                    ],
                                    [
                                        'route' => route('permissions.groups', $permission->id ), 
                                        'color' => 'dark',
                                        'icon' => 'layer-group',
                                        'label' => 'Grupos'
                                    ],
                                    [
                                        'route' => route('permissions.show', $permission->id ), 
                                        'color' => 'secondary',
                                        'icon' => 'eye',
                                        'label' => 'Ver'
                                    ],
                                    [
                                        'route' => route('permissions.edit', $permission->id ), 
                                        'color' => 'primary',
                                        'icon' => 'edit',
                                        'label' => 'Editar'
                                    ]
                                ], 'item', 'admin.includes.forms_actions')
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
                {!! $permissions->appends($filters)->onEachSide(5)->links() !!}
            @else
                {!! $permissions->onEachSide(5)->links() !!}
            @endif
        </div>
    </div>
@stop