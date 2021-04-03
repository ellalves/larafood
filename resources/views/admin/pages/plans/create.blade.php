@extends('adminlte::page')

@section('title', 'Cadastrar novo Plano')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"> Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}"> Planos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('plans.create', $plan->url) }}" class="active"> novo</a></li>
    </ol>
    <h1> Cadastrar novo plano </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('plans.store') }}" method="POST" class="form">
                @include('admin.pages.plans._partials.form')
            </form>
        </div>
    </div>
@stop