@extends('adminlte::page')

@section('title', "Visualizar o detalhe: $detail->name")

@section('content_header')
    {{ Breadcrumbs::render('PlansDetailsCreate', $plan)}}
    <h1>Visualizar o detalhe: <strong>{{ $detail->name }}</strong> </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong>{{ $detail->name }}
                </li>
            </ul>
        </div>
        <div class="card-footer">
            <form action="{{ route('details.plan.destroy', [$plan->url, $detail->id])}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"> Deletar o detalhe</button>
            </form>
        </div>
    </div>
@stop