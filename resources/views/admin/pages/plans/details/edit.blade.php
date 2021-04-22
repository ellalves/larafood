@extends('adminlte::page')

@section('title', "Editar o detalhe: $detail->name")

@section('content_header')
    {{ Breadcrumbs::render('PlansDetailsEdit', $plan)}}
    <h1>Editar o detalhe: <strong>{{ $detail->name }}</strong> </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('details.plan.update', [$plan->url,$detail->id])}}" method="post">
                @method('PUT')
                @include('admin.pages.plans.details._partials.form')
            </form>
        </div>
    </div>
@stop