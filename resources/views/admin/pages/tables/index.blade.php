@extends('adminlte::page')

@section('title', __('Registered Tables'))

@section('content_header')
    {{ Breadcrumbs::render('tables') }}
    <h1> {{ __('Registered Tables') }} </h1>
@stop

@section('content')
    <div class="card">

        <div class="div card-header">
            @include('admin.includes.search', [
            'route' => route('tables.search'),
            'add' => route('tables.create')
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
                    @foreach ($tables as $table)
                        <tr>
                            <td class="align-middle">{{ $table->name }}</td>
                            <td class="align-middle float-right">
                                @each('admin.includes.forms_actions', ['items' =>
                                [
                                'route' => route('tables.qrcode', $table->id),
                                'color' => 'dark',
                                'icon' => 'qrcode',
                                'label' => __("QR Code"),
                                'target' => '_blank'
                                ],
                                [
                                'route' => route('tables.show', $table->id),
                                'color' => 'secondary',
                                'icon' => 'eye',
                                'label' => __("View")
                                ],
                                [
                                'route' => route('tables.edit', $table->id),
                                'color' => 'primary',
                                'icon' => 'edit',
                                'label' => _("Edit")
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
                {!! $tables->appends($filters)->onEachSide(5)->links() !!}
            @else
                {!! $tables->onEachSide(5)->links() !!}
            @endif
        </div>
    </div>
@stop
