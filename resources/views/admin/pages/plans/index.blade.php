@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
    <h1>Planos <a href="{{ route('plans.create') }}" class="btn btn-success"> <i class="fas fa-plus-square"></i> NOVO</a> </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"> Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.index') }}" class="active"> Planos</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="div card-header">
            <form action="{{ route('plans.search') }}" method="post" class="form form-inline">
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
                        <th>Preço</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($plans as $plan)
                        <tr>
                            <td>{{ $plan->name }}</td>
                            <td>R$ {{ number_format($plan->price, 2, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('details.plan.index', $plan->url ) }}" class="btn btn-primary">Detalhes</a>
                                <a href="{{ route('plans.show', $plan->url ) }}" class="btn btn-warning">Ver</a>
                                <a href="{{ route('plans.edit', $plan->url ) }}" class="btn btn-info">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $plans->appends($filters)->onEachSide(5)->links() !!}
            @else
                {!! $plans->onEachSide(5)->links() !!}
            @endif
        </div>
    </div>
@stop