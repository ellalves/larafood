@extends('adminlte::page')

@section('title', __("Edit User"))

@section('content_header')
    {{ Breadcrumbs::render('usersEdit')}}
    <h1> {{__("Edit User") }} </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST" class="form">
                @method('PUT')
                @include('admin.pages.users._partials.form')
            </form>
        </div>
    </div>
@stop