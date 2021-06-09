@extends('adminlte::page')

@section('title', __('Registered Roles'))

@section('content_header')
    {{ Breadcrumbs::render('roles') }}
    <h1> {{ __('Registered Roles') }} </h1>
@stop

@section('content')
    <div class="card">

        <div class="div card-header px-4">
            @include('admin.includes.search', [
                'route' => route('roles.search'),
                'add' => route('roles.create')
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
                    @forelse($roles as $role)
                        <tr>
                            <td class="align-middle">{{ $role->name }}</td>
                            <td class="align-middle float-right">
                                @each('admin.includes.forms_actions', ['items' => 
                                    [
                                        'route' => route('roles.users', $role->id), 
                                        'color' => 'info',
                                        'icon' => 'user',
                                        'label' => __('Users')
                                    ],                               
                                    [
                                        'route' => route('roles.permissions', $role->id), 
                                        'color' => 'dark',
                                        'icon' => 'lock',
                                        'label' => __('Permissions')
                                    ],
                                    [
                                        'route' => route('roles.show', $role->id), 
                                        'color' => 'secondary',
                                        'icon' => 'eye',
                                        'label' => __('View')
                                    ],
                                    [
                                        'route' => route('roles.edit', $role->id), 
                                        'color' => 'primary',
                                        'icon' => 'edit',
                                        'label' => __('Edit')
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