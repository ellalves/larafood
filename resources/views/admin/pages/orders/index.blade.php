@extends('adminlte::page')

@section('title', __('Registered Orders'))

@section('content_header')
    {{ Breadcrumbs::render('orders') }}

    <h1> {{ __('Registered Orders') }} </h1>
@stop

@section('content')
    <div id="app" class="card">
        <orders-tenant></orders-tenant>
    </div>
@stop

@section('adminlte_js')
<script src="{{ asset('js/app.js') }}"></script>
@stop

@push('scripts-header')
<script>
    window.Laravel = {!! json_encode([
        'tenantId' => auth()->check() ? auth()->user()->tenant_id : ''
    ]) !!}
</script>
@endpush