@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
    {{ Breadcrumbs::render('plans') }}
    <h1>Planos</h1>
@stop

@section('content')
    <div class="card">
        
        @include('admin.includes.alerts')
        
        <div class="div card-header">
            @include('admin.includes.search', [
                'route' => route('plans.search'), 
                'add' => route('plans.create')
            ])
        </div>
        
        <div class="div card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Preço</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($plans as $plan)
                        <tr>
                            <td class="align-middle">{{ $plan->name }}</td>
                            <td class="align-middle">R$ {{ number_format($plan->price, 2, ',', '.') }}</td>
                            <td class="align-middle">
                                @each('admin.includes.forms_actions', ['items' => 
                                    [
                                        'route' => route('details.plan.index', $plan->url), 
                                        'color' => 'info',
                                        'icon' => 'plus',
                                        'label' => 'Detalhes'
                                    ],                                
                                    [
                                        'route' => route('plans.groups', $plan->id), 
                                        'color' => 'dark',
                                        'icon' => 'layer-group',
                                        'label' => 'Grupos'
                                    ],
                                    [
                                        'route' => route('plans.show', $plan->url), 
                                        'color' => 'secondary',
                                        'icon' => 'eye',
                                        'label' => 'Ver'
                                    ],
                                    [
                                        'route' => route('plans.edit', $plan->url), 
                                        'color' => 'primary',
                                        'icon' => 'edit',
                                        'label' => 'Editar'
                                    ]
                                ], 'item', 'admin.includes.forms_actions')
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $plans->appends($filters)->onEachSide(5)->links() !!}
            @else
                {!! $plans->onEachSide(5)->links() !!}
            @endif
        </div>
    </div>
@stop