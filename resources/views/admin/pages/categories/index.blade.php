@extends('adminlte::page')

@section('title', __('Registered Categories'))

@section('content_header')
    {{ Breadcrumbs::render('categories') }}
    <h1>{{ __('Registered Categories') }}</h1>
@stop

@section('content')
    <div class="card">

        <div class="div card-header px-4">
            @include('admin.includes.search', [
                'route' => route('categories.search'), 
                'add' => route('categories.create')
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
                    @foreach($categories as $category)
                        <tr>
                            <td class="align-middle">{{ $category->name }}</td>
                            <td class="align-middle float-right">
                                @each('admin.includes.forms_actions', ['items' => 
                                [
                                    'route' => route('categories.show', $category->id), 
                                    'color' => 'secondary',
                                    'icon' => 'eye',
                                    'label' => __('View')
                                ],
                                [
                                    'route' => route('categories.edit', $category->id), 
                                    'color' => 'primary',
                                    'icon' => 'edit',
                                    'label' => __('Edit')
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
                {!! $categories->appends($filters)->onEachSide(5)->links() !!}
            @else
                {!! $categories->onEachSide(5)->links() !!}
            @endif
        </div>
    </div>
@stop