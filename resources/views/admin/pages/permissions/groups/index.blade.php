@extends('adminlte::page')

@section('title', "Grupos por permissão {$permission->name} ")

@section('content_header')
    {{ Breadcrumbs::render('permissionsGroup', $permission) }}
    <h1>Grupos por permissão: <strong>{{$permission->name}}</strong> </h1>
@stop

@section('content')
    <div class="card">

        @include('admin.includes.alerts')

        <div class="div card-header">
            @include('admin.includes.search', [
                'route' => null,
                'add' => route('permissions.groups.available', $permission->id),
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
                    @foreach($groups as $group)
                        <tr>
                            <td>{{ $group->name }}</td>
                            <td>
                                @each('admin.includes.forms_actions', ['items' =>                               
                                    [
                                        'route' => route('permissions.groups.detach', [$group->id, $permission->id]), 
                                        'color' => 'danger',
                                        'icon' => 'unlink',
                                        'label' => 'Desvincular'
                                    ]
                                ], 'item')
                             </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop