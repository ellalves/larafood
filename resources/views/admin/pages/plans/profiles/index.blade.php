@extends('adminlte::page')

@section('title', "Perfis do plano {$plan->name} ")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"> Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}"> Planos </a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.profiles', $plan->id) }}"> Perfis</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('plans.profiles.available', $plan->id) }}" class="active"> Disponíveis</a></li>
    </ol>
    <h1>Perfis disponíveis para o plano <strong>{{$plan->name}}</strong> <a href="{{ route('plans.profiles.available', $plan->id) }}" class="btn btn-success"> <i class="fas fa-plus-square"></i> NOVO PERFIL </a> </h1>
@stop

@section('content')
    <div class="card">

        @include('admin.includes.alerts')

        <div class="div card-header">
            <form action="{{ route('profiles.search') }}" method="post" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Nome" value="{{ $filters['filter'] ?? '' }}" class="form-control">
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>
        <div class="div card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($profiles as $profile)
                        <tr>
                            <td>{{ $profile->name }}</td>
                            <td>
                                <a href="{{ route('plans.profiles.detach', [$plan->id, $profile->id] ) }}" class="btn btn-info">Desvincular</a>
                             </td>
                        </tr>
                    @endforeach
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