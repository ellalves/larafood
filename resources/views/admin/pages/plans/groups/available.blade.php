@extends('adminlte::page')

@section('title', "Grupos disponíveis para o Plano $plan->name")

@section('content_header')
    {{ Breadcrumbs::render('plansGroupsAvailable', $plan) }}
    <h1>Grupos disponíveis para o Plano <strong>{{$plan->name}}</strong>
@stop

@section('content')
    <div class="card">

        @include('admin.includes.alerts')
        
        <div class="div card-header">
            @include('admin.includes.search', [
                'route' => route('plans.groups', $plan->id)
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
                    <form action="{{ route('plans.groups.attach', $plan->id)}}" method="post">
                        @csrf

                        @foreach($groups as $group)
                            <tr>
                                <td><input id="{{ $group->id }}" type="checkbox" name="groups[]" value="{{ $group->id }}"></td>
                                <td><label for="{{ $group->id }}">{{ $group->name }}</label></td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="500">
                                @if (count($groups) > 0)
                                    <button type="submit" class="btn btn-dark">
                                        <i class="fas fa-link"></i> Vincular
                                    </button>
                                @else
                                    <p class="alert alert-warning">
                                        <i class="icon fas fa-exclamation-triangle"></i>
                                        Nenhum grupo disponível para esse plano!
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
                {!! $groups->appends($filters)->onEachSide(5)->links() !!}
            @else
                {!! $groups->onEachSide(5)->links() !!}
            @endif
        </div>
    </div>
@stop