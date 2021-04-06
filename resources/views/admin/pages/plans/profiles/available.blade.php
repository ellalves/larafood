@extends('adminlte::page')

@section('title', "Perfis do Plano {{ $plan->name }} ")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"> Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('profiles.index') }}" class="active"> Perfis</a></li>
    </ol>
    <h1>Perfis do Plano <strong>{{$plan->name}}</strong>
@stop

@section('content')
    <div class="card">

        @include('admin.includes.alerts')

        <div class="div card-header">
            <form action="{{ route('plans.profiles.attach', $plan->id) }}" method="post" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Nome" value="{{ $filters['filter'] ?? '' }}" class="form-control">
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
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
                    <form action="{{ route('plans.profiles.attach', $plan->id)}}" method="post">
                        @csrf

                        @foreach($profiles as $profile)
                            <tr>
                                <td><input id="{{ $profile->id }}" type="checkbox" name="profiles[]" value="{{ $profile->id }}"></td>
                                <td><label for="{{ $profile->id }}">{{ $profile->name }}</label></td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="500">
                                <button type="submit" class="btn btn-dark">Vincular</button>
                            </td>
                        </tr>                      
                    </form>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $profiles->appends($filters)->onEachSide(5)->links() !!}
            @else
                {!! $profiles->onEachSide(5)->links() !!}
            @endif
        </div>
    </div>
@stop