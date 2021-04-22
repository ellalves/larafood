@extends('adminlte::page')

@section('title', 'Grupos Cadastrados')

@section('content_header')
    {{ Breadcrumbs::render('groups') }}
    <h1>Grupos Cadastrados</h1>
@stop

@section('content')
    <div class="card">
        @include('admin.includes.alerts')

        <div class="div card-header">
            @include('admin.includes.search', [
                'route' => route('groups.search'),
                'add' => route('groups.create')
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
                                        'route' => route('groups.permissions', $group->id), 
                                        'color' => 'dark',
                                        'icon' => 'lock',
                                        'label' => 'Permissões'
                                    ],
                                    [
                                        'route' => route('groups.show', $group->id), 
                                        'color' => 'secondary',
                                        'icon' => 'eye',
                                        'label' => 'Ver'
                                    ],
                                    [
                                        'route' => route('groups.edit', $group->id), 
                                        'color' => 'primary',
                                        'icon' => 'edit',
                                        'label' => 'Editar'
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