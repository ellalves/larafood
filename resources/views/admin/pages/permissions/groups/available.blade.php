@extends('adminlte::page')

@section('title', __('Permissions available for the group') . ': ' . $permission->name )

@section('content_header')
    {{ Breadcrumbs::render('permissionGroups', $permission) }}
    <h1>{{ __('Permissions available for the group') }}: <strong>{{$permission->name}}</strong>
@stop

@section('content')
    <div class="card">

        <div class="div card-header px-4">
            @include('admin.includes.search', [
                'route' => route('permissions.groups.available', $permission->id)
            ])
        </div>

        <div class="div card-body table-responsive">

            @include('admin.includes.alerts')

            <table class="table table-condensed table-dark table-striped table-hover table-borderless align-middle">
                <tbody>
                    <form action="{{ route('permissions.groups.attach', $permission->id)}}" method="post">
                        @csrf

                        <tr class="row mx-0">
                            @foreach ($groups as $group)
                                <td class="align-middle">
                                    <div class="form-group col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                        <div class="custom-control custom-switch custom-switch-on-success">
                                            <input type="checkbox" name="groups[]" value="{{ $group->id }}" class="custom-control-input" id="{{ $group->id }}">
                                            <label class="custom-control-label" for="{{ $group->id }}">
                                                {{ $group->name }}
                                            </label>
                                        </div>
                                    </div>

                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="align-middle">
                                @if (count($groups) > 0)
                                    @include('admin.includes.button_save', [
                                        'btnIcon' => 'link',
                                        'btnSave' => __('Link'),
                                    ])
                                @else
                                    @include('admin.includes.alerts_messages', ['msg' => __('messages.no_options_available') ])
                                @endif
                            </td>
                        </tr>                      
                    </form>
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