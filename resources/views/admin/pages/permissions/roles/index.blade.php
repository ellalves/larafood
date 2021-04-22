@extends('adminlte::page')

@section('title', "Cargos da permissão {$permission->name} ")

@section('content_header')
    {{ Breadcrumbs::render('PermissionsRoles', $permission) }}
    <h1>Cargos da permissão: <strong>{{$permission->name}}</strong> </h1>
@stop

@section('content')
    <div class="card">

        @include('admin.includes.alerts')

        <div class="div card-header">
            @include('admin.includes.search', [
                'route' => null,
                'add' => route('permissions.roles.available', $permission->id),
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
                    @forelse($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>
                                @each('admin.includes.forms_actions', ['items' =>                               
                                    [
                                        'route' => route('permissions.roles.detach', [$role->id, $permission->id]), 
                                        'color' => 'danger',
                                        'icon' => 'unlink',
                                        'label' => 'Desvincular'
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
    </div>
@stop