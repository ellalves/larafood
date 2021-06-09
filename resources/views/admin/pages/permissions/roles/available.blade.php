@extends('adminlte::page')

@section('title', __('Roles available for permission') . ': ' . $permission->name )

@section('content_header')
    {{ Breadcrumbs::render('permissionRolesAvailable', $permission) }}
    <h1> {{ __('Roles available for permission') }}: <strong>{{$permission->name}}</strong>
@stop

@section('content')
    <div class="card">

        <div class="div card-header px-4">
            @include('admin.includes.search', [
                'route' => route('permissions.roles.available', $permission->id)
            ])
        </div>

        <div class="div card-body table-responsive">

            @include('admin.includes.alerts')

            <table class="table table-condensed table-dark table-striped table-hover table-borderless align-middle">
                <tbody>
                    <form action="{{ route('permissions.roles.attach', $permission->id)}}" method="post">
                        @csrf

                        <tr class="row mx-0">
                            @foreach ($roles as $role)
                                <td class="align-middle">

                                    <div class="form-group col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                        <div class="custom-control custom-switch custom-switch-on-success">
                                            <input type="checkbox" name="roles[]" value="{{ $role->id }}" class="custom-control-input" id="{{ $role->id }}">
                                            <label class="custom-control-label" for="{{ $role->id }}">
                                                {{ $role->name }}
                                            </label>
                                        </div>
                                    </div>
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="align-middle">
                                @if (count($roles) > 0)
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
                {!! $roles->appends($filters)->onEachSide(5)->links() !!}
            @else
                {!! $roles->onEachSide(5)->links() !!}
            @endif
        </div>
    </div>
@stop