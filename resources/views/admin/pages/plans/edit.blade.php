@extends('adminlte::page')

@section('title', __('Edit Plan'))

@section('content_header')
    {{ Breadcrumbs::render('plansEdit')}}
    <h1> {{ __('Edit Plan') }} </h1>
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