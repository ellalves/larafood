@extends('adminlte::page')

@section('title', __('Registered Groups')) 

@section('content_header')
    {{ Breadcrumbs::render('groups') }}
    <h1>{{ __('Registered Groups') }}</h1>
@stop

@section('content')
    <div class="card">

        <div class="div card-header px-4"> 
            @include('admin.includes.search', [
                'route' => route('groups.search'),
                'add' => route('groups.create')
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
                    @foreach($groups as $group)
                        <tr>
                            <td class="align-middle">{{ $group->name }}</td>
                            <td class="align-middle float-right">
                                @each('admin.includes.forms_actions', ['items' =>                               
                                    [
                                        'route' => route('groups.permissions', $group->id), 
                                        'color' => 'dark',
                                        'icon' => 'lock',
                                        'label' => __('Permissions')
                                    ],
                                    [
                                        'route' => route('groups.show', $group->id), 
                                        'color' => 'secondary',
                                        'icon' => 'eye',
                                        'label' => __('View')
                                    ],
                                    [
                                        'route' => route('groups.edit', $group->id), 
                                        'color' => 'primary',
                                        'icon' => 'edit',
                                        'label' => __('Edit')
                                    ]
                                ], 'item')
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $groups->appends($filters)->onEachSide(5)->links() !!}
            @else
                {!! $groups->onEachSide(5)->links() !!}
            @endif
        </div>
    </div>
@stop