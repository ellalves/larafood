@extends('adminlte::page')

@section('title', "Grupos do plano {$plan->name} ")

@section('content_header')
    {{ Breadcrumbs::render('plansGroups', $plan) }}
    <h1>Grupos disponíveis para o plano: <strong>{{$plan->name}}</strong></h1>
@stop

@section('content')
    <div class="card">

        @include('admin.includes.alerts')

        <div class="div card-header">
            @include('admin.includes.search', [
                'route' => null,
                'add' => route('plans.groups.available', $plan->id),
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
                                        'route' => route('plans.groups.detach', [$plan->id, $group->id] ), 
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
        <div class="card-footer">
            @if (isset($filters))
                {!! $groups->appends($filters)->onEachSide(5)->links() !!}
            @else
                {!! $groups->onEachSide(5)->links() !!}
            @endif
        </div>
    </div>
@stop