@extends('adminlte::page')

@section('title', "Detalhes do Plano")

@section('content_header')
    {{ Breadcrumbs::render('plansView')}}
    <h1> Detalhes do plano</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $plan->name}}
                </li>
                <li>
                    <strong>Url: </strong> {{ $plan->url}}
                </li>
                <li>
                    <strong>Price: </strong> {{ number_format($plan->price, 2, ',', '.') }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $plan->description}}
                </li>
            </ul>
            
            @include('admin.includes.alerts')

            <form action="{{ route('plans.destroy', $plan->url) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    Deletar o plano ({{ $plan->name }})
                </button>
            </form>

        </div>
    </div>
@stop