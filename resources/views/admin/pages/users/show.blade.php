@extends('adminlte::page')

@section('title', "Visualizar o usuário")

@section('content_header')
    {{ Breadcrumbs::render('usersView')}}
    <h1> Visualizar o usuário</h1>
@stop

@section('content')
    <div class="card">
            <div class="card-body">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                    <li class="item">
                        <div class="product-img">
                            <img src="{{ !empty($user->logo) ? url("storage/$user->logo") : url("images/user-profile-none.png") }}" alt="{{ $user->photo }}" class="img-fluid img-size-250">
                        </div>
                        <div class="product-info">

                            <a href="{{ route('users.edit', $user->id) }}" class="product-title"> 
                                {{ $user->name }}
                                <span class="badge badge-light float-right">
                                    {{ $user->active == 'Y' ? __('Active') : __('Inactive') }}
                                </span>
                            </a>

                            <span class="product-description">
                                {{ $user->bio }}
                            </span>
                        </div>
                    </li>
                    <li>
                        <strong>{{ __("Responsible") }}: </strong> {{ $user->name }}
                    </li>
                    <li>
                        <strong>{{ __("Cellular phone") }}: </strong> {{ $user->phone }}
                    </li>
                    <li>
                        <strong> {{ __("Document") }}: </strong> {{ $user->document }}
                    </li>
                    <li>
                        <strong> {{ __("Email") }}: </strong> {{ $user->email }}
                    </li>
                    <li> <strong> {{ __("Roles") }}:</strong>
                        <ul>
                            @foreach ($user->roles as $role)
                            <li class="products-list product-list-in-card">
                                <i class="fas fa-check-square"></i> {{ $role->name }}
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <strong> {{ __("UUID") }}: </strong> {{ $user->uuid }}
                    </li>
                    <li>
                        <strong> {{ __("Created At") }}: </strong> {{ $user->created }}
                    </li>
                    <li>
                        <strong> {{ __("Updated At") }}: </strong> {{ $user->updated}}
                    </li>
                </ul>
            </div>

        <div class="card-footer">
            @include('admin.includes.button_delete', [
            'pathDelete' => route('users.destroy', $user->id)
            ])
        </div>
    </div>
@stop