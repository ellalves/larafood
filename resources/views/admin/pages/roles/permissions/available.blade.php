@extends('adminlte::page')

@section('title', "Permissões disponíveis para o cargo: $role->name")

@section('content_header')
    {{ Breadcrumbs::render('RolePermissionAvailable', $role) }}
    <h1>Permissões disponíveis para o cargo:  <strong>{{$role->name}}</strong>
@stop

@section('content')
    <div class="card">

        @include('admin.includes.alerts')

        <div class="div card-header">
            @include('admin.includes.search', [
                'route' => route('roles.permissions.available', $role->id)
            ])
        </div>

        <div class="div card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th width="50px">#</th>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('roles.permissions.attach', $role->id)}}" method="post">
                        @csrf

                        @foreach($permissions as $permission)
                            <tr>
                                <td><input id="{{$permission->id}}" type="checkbox" name="permissions[]" value="{{ $permission->id }}"></td>
                                <td><label  for="{{$permission->id}}">
                                    {{ $permission->name }}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="500">
                                @if (count($permissions) > 0)
                                    <button type="submit" class="btn btn-dark">
                                        <i class="fas fa-link"></i> Vincular
                                    </button>
                                @else
                                    @include('admin.includes.alerts', ['msg' => __('messages.no_options_available') ])
                                @endif
                            </td>
                        </tr>
                    </form>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $permissions->appends($filters)->onEachSide(5)->links() !!}
            @else
                {!! $permissions->onEachSide(5)->links() !!}
            @endif
        </div>
    </div>
@stop