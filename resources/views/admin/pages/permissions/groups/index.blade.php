@extends('adminlte::page')

@section('title', __("Permission Groups") . ': ' . $permission->name )

@section('content_header')
    {{ Breadcrumbs::render('permissionsGroup', $permission) }}
    <h1>{{ __("Permission Groups") }}: <strong>{{$permission->name}}</strong> </h1>
@stop

@section('content')
    <div class="card">    

        <div class="div card-header px-4">
            @include('admin.includes.search', [
                'route' => null,
                'add' => route('permissions.groups.available', $permission->id),
                'label' => __("Link"),
                'icon' => 'link'
            ])
        </div>

        <div class="div card-body table-responsive">

            @include('admin.includes.alerts')
            
            <table class="table table-condensed table-dark table-striped table-hover table-borderless align-middle">
                <thead>
                    <tr>
                        <th>{{ __('Name') }}</th>
                        <th scope="col" class="float-right mr-4">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($groups as $group)
                        <tr>
                            <td class="align-middle">{{ $group->name }}</td>
                            <td class="align-middle float-right">
                                @each('admin.includes.forms_actions', ['items' =>                               
                                    [
                                        'route' => route('permissions.groups.detach', [$group->id, $permission->id]), 
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