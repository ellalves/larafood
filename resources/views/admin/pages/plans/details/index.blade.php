@extends('adminlte::page')

@section('title', __("Plan Details") . ': ' . $plan->name)

@section('content_header')
    {{ Breadcrumbs::render('details', $plan) }}
    <h1> {{ __("Plan Details") }}: <strong>{{ $plan->name }}</strong> 
@stop

@section('content')
    <div class="card">

        <div class="div card-header px-4">
            @include('admin.includes.search', [
                'route' => null, 
                'add' => route('details.plan.create', $plan->url)
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
                    @foreach($details as $detail)
                        <tr>
                            <td class="align-middle">{{ $detail->name }}</td>
                            <td class="align-middle float-right">
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