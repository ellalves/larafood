@extends('adminlte::page')

@section('title', __("Edit Group"))

@section('content_header')
    {{ Breadcrumbs::render('groupsEdit') }}
    <h1> {{ __("Edit Group") }} </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('groups.update', $group->id) }}" method="POST" class="form">
                @method('PUT')
                @include('admin.pages.groups._partials.form')
            </form>
        </div>
    </div>
@stop