@extends('adminlte::page')

@section('title', __("Role Users") . ': ' . $role->name )

@section('content_header')
    {{ Breadcrumbs::render('roleUsers', $role) }}
    <h1> {{ __("Role Users") }}: <strong>{{$role->name}}</strong> </h1>
@stop

@section('content')
    <div class="card">

        <div class="div card-header px-4">
            @include('admin.includes.search', [
                'route' => null,
                'add' => route('roles.users.available', $role->id),
                'label' => __('Link'),
                'icon' => 'link'
            ])
        </div>

        <div class="div card-body table-responsive">

            @include('admin.includes.alerts')

            <table class="table table-condensed table-dark table-striped table-hover table-borderless align-middle">
                <thead>
                    <tr>
                        <th scope="col">{{ __('Name') }}</th>
                        <th scope="col" class="float-right mr-4">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td class="align-middle">{{ $user->name }}</td>
                            <td class="align-middle float-right">
                                @each('admin.includes.forms_actions', ['items' =>                               
                                    [
                                        'route' => route('roles.users.detach', [$role->id, $user->id]), 
                                        'color' => 'danger',
                                        'icon' => 'unlink',
                                        'label' => __('Unlink')
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