@extends('adminlte::page')

@section('title', "Permissões disponíveis para o grupo: $user->name")

@section('content_header')
    {{ Breadcrumbs::render('userRolesAvailable', $user) }}
    <h1>Permissões disponíveis para o grupo: <strong>{{$user->name}}</strong>
@stop

@section('content')
    <div class="card">

    @include('admin.includes.alerts')

        <div class="div card-header">
            @include('admin.includes.search', [
                'route' => route('users.roles.available', $user->id)
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
                    <form action="{{ route('users.roles.attach', $user->id)}}" method="post">
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