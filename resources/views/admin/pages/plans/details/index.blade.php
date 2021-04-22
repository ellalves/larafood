@extends('adminlte::page')

@section('title', "Detalhes do plano: $plan->name")

@section('content_header')
    {{ Breadcrumbs::render('details', $plan) }}
    <h1>Detalhes do plano: <strong>{{ $plan->name }}</strong> 
@stop

@section('content')
    <div class="card">

        @include('admin.includes.alerts')

        <div class="div card-header">
            @include('admin.includes.search', [
                'route' => null, 
                'add' => route('details.plan.create', $plan->url)
            ])
        </div>
        
        <div class="div card-body">
            
            @include('admin.includes.alerts')

            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($details as $detail)
                        <tr>
                            <td class="align-middle">{{ $detail->name }}</td>
                            <td class="align-middle">
                                @each('admin.includes.forms_actions', ['items' => 
                                    [
                                        'route' => route('details.plan.show', [$plan->url, $plan->id]), 
                                        'color' => 'secondary',
                                        'icon' => 'eye',
                                        'label' => 'Ver'
                                    ],
                                    [
                                        'route' => route('details.plan.edit', [$plan->url, $plan->id]), 
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
                {!! $details->appends($filters)->onEachSide(5)->links() !!}
            @else
                {!! $details->onEachSide(5)->links() !!}
            @endif
        </div>
    </div>
@stop