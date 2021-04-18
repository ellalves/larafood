@extends('adminlte::page')

@section('title', "Permissões disponíveis para o grupo: $group->name")

@section('content_header')
    {{ Breadcrumbs::render('groupPermissions', $group) }}
    <h1>Permissões disponíveis para o grupo:  <strong>{{$group->name}}</strong>
@stop

@section('content')
    <div class="card">

        @include('admin.includes.alerts')

        <div class="div card-header">
            @include('admin.includes.search', [
                'route' => route('groups.permissions.available', $group->id)
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
                    <form action="{{ route('groups.permissions.attach', $group->id)}}" method="post">
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
                                    <p class="alert alert-warning">
                                        <i class="icon fas fa-exclamation-triangle"></i>
                                        Nenhum grupo disponível para essa permissão!
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
                {!! $permissions->appends($filters)->onEachSide(5)->links() !!}
            @else
                {!! $permissions->onEachSide(5)->links() !!}
            @endif
        </div>
    </div>
@stop