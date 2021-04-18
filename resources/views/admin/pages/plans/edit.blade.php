@extends('adminlte::page')

@section('title', "Editar Plano")

@section('content_header')
    {{ Breadcrumbs::render('plansEdit')}}
    <h1> Editar plano: </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('plans.update', $plan->url) }}" method="POST" class="form">
                @method('PUT')
                @include('admin.pages.plans._partials.form')
            </form>
        </div>
    </div>
@stop