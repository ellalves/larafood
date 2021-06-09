@extends('adminlte::page')

@section('title', __('Plan Details') . ': ' . $plan->name)

@section('content_header')
    {{ Breadcrumbs::render('PlansDetailsCreate', $plan)}}
    <h1> {{ __('Plan Details') }}: <strong>{{ $plan->name }}</strong> </h1>
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