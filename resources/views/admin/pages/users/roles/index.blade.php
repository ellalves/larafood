@extends('adminlte::page')

@section('title', "Cargos do usuário: $user->name")

@section('content_header')
    {{ Breadcrumbs::render('userRoles', $user) }}
    <h1>Cargos da permissão: <strong>{{$user->name}}</strong> </h1>
@stop

@section('content')
    <div class="card">

        @include('admin.includes.alerts')

        <div class="div card-header">
            @include('admin.includes.search', [
                'route' => null,
                'add' => route('users.roles.available', $user->id),
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
                                        'route' => route('users.roles.detach', [$role->id, $user->id]), 
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