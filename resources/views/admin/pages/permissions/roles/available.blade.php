@extends('adminlte::page')

@section('title', "Permissões disponíveis para o grupo: {{ $permission->name }} ")

@section('content_header')
    {{ Breadcrumbs::render('permissionRolesAvailable', $permission) }}
    <h1>Permissões disponíveis para o grupo: <strong>{{$permission->name}}</strong>
@stop

@section('content')
    <div class="card">

    @include('admin.includes.alerts')

        <div class="div card-header">
            @include('admin.includes.search', [
                'route' => route('permissions.roles.available', $permission->id)
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
                    <form action="{{ route('permissions.roles.attach', $permission->id)}}" method="post">
                        @csrf

                        @foreach($roles as $role)
                            <tr>
                                <td><input id="{{$role->id}}" type="checkbox" name="roles[]" value="{{ $role->id }}"></td>
                                <td>
                                    <label for="{{$role->id}}">{{ $role->name }}</label>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="500">
                                @if (count($roles) > 0)
                                    <button type="submit" class="btn btn-dark">
                                        <i class="fas fa-link"></i> Vincular
                                    </button>
                                @else
                                    <p class="alert alert-warning">
                                        <i class="icon fas fa-exclamation-triangle"></i>
                                        @include('admin.includes.alerts_messages', ['msg' => __('messages.no_options_available') ])
                                    </p>
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