@extends('adminlte::page')

@section('title', "Cadastrar detalhes do plano: $plan->name")

@section('content_header')
    {{ Breadcrumbs::render('PlansDetailsCreate', $plan)}}
    <h1>Cadastrar detalhes do plano: <strong>{{ $plan->name }}</strong> </h1>

@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('details.plan.store', $plan->url)}}" method="post">
                @include('admin.pages.plans.details._partials.form')
            </form>
        </div>
    </div>
@stop