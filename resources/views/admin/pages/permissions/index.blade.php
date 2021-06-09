@extends('adminlte::page')

@section('title', __('Registered Permissions'))

@section('content_header')
    {{ Breadcrumbs::render('permissions') }}
    <h1>{{ __('Registered Permissions') }}</h1>
@stop

@section('content')
    <div class="card">

        <div class="div card-header px-4">
            @include('admin.includes.search', [
                'route' => route('permissions.search'), 
                'add' => route('permissions.create')
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
                    @forelse($permissions as $permission)
                        <tr>
                            <td class="align-middle">{{ $permission->name }}</td>
                            <td class="align-middle float-right">
                                @each('admin.includes.forms_actions', ['items' => 
                                    [
                                        'route' => route('permissions.roles', $permission->id ), 
                                        'color' => 'info',
                                        'icon' => 'address-book',
                                        'label' => __('Roles')
                                    ],
                                    [
                                        'route' => route('permissions.groups', $permission->id ), 
                                        'color' => 'dark',
                                        'icon' => 'layer-group',
                                        'label' => __('Groups')
                                    ],
                                    [
                                        'route' => route('permissions.show', $permission->id ), 
                                        'color' => 'secondary',
                                        'icon' => 'eye',
                                        'label' => __('View')
                                    ],
                                    [
                                        'route' => route('permissions.edit', $permission->id ), 
                                        'color' => 'primary',
                                        'icon' => 'edit',
                                        'label' => __('Edit')
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