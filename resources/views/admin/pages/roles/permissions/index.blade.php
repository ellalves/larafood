@extends('adminlte::page')

@section('title', "Permissões do cargo {$role->name} ")

@section('content_header')
    {{ Breadcrumbs::render('rolesPermissions', $role) }}
    <h1>Permissões do cargo: <strong>{{$role->name}}</strong></h1>
@stop

@section('content')
    <div class="card">

        @include('admin.includes.alerts')

        <div class="div card-header">
            @include('admin.includes.search', [
                'route' => null,
                'add' => route('roles.permissions.available', $role->id),
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
                    @forelse($permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>
                                @each('admin.includes.forms_actions', ['items' =>                               
                                    [
                                        'route' => route('roles.permissions.detach', [$role->id, $permission->id]), 
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
                            @include('admin.includes.alerts', ['msg' => __('messages.no_link_yet') ])
                        </td>
                    </tr>
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