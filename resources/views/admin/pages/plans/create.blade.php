@extends('adminlte::page')

@section('title', __('Register Plan'))

@section('content_header')
    {{ Breadcrumbs::render('plansCreate') }}
    <h1> {{ __('Register Plan') }} </h1>
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