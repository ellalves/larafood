@extends('adminlte::page')

@section('title', "Usuários disponíveis para o cargo: $role->name")

@section('content_header')
    {{ Breadcrumbs::render('roleUsersAvailable', $role) }}
    <h1>Usuários disponíveis para o cargo: <strong>{{$role->name}}</strong>
@stop

@section('content')
    <div class="card">

    @include('admin.includes.alerts')

        <div class="div card-header">
            @include('admin.includes.search', [
                'route' => route('roles.users.available', $role->id)
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
                    <form action="{{ route('roles.users.attach', $role->id)}}" method="post">
                        @csrf

                        @foreach($users as $user)
                            <tr>
                                <td><input id="{{$user->id}}" type="checkbox" name="users[]" value="{{ $user->id }}"></td>
                                <td>
                                    <label for="{{$user->id}}">{{ $user->name }}</label>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="500">
                                @if (count($users) > 0)
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
                {!! $users->appends($filters)->onEachSide(5)->links() !!}
            @else
                {!! $users->onEachSide(5)->links() !!}
            @endif
        </div>
    </div>
@stop