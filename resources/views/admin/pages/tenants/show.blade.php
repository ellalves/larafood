@extends('adminlte::page')

@section('title', __("View Company") )

    @section('content_header')
        {{ Breadcrumbs::render('tenantsView') }}
        <h1> {{ __("View Company") }} </h1>
    @stop

    @section('content')
        <div class="card">
            <div class="card-body">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                    <li class="item">
                        <div class="product-img">
                            <img src="{{ !empty($tenant->logo) ? url("storage/$tenant->logo") : url("images/company_none.png") }}" alt="{{ $tenant->logo }}" class="img-size-250">
                        </div>
                        <div class="product-info">
                            <a href="{{ route('tenants.index', $tenant->id) }}" class="product-title"> {{ $tenant->name }}
                                <span class="badge badge-light float-right">
                                    {{ $tenant->plan->name }}
                                </span>
                            </a>
                            <span class="product-description">
                                {{ $tenant->bio }}
                            </span>
                        </div>
                    </li>
                    <li>
                        <strong>{{ __("Responsible") }}: </strong> {{ $user->name }}
                    </li>
                    <li>
                        <strong>{{ __("Cellular phone") }}: </strong> {{ $tenant->phone }}
                    </li>
                    <li>
                        <strong> {{ __("Document") }}: </strong> {{ $tenant->document }}
                    </li>
                    <li>
                        <strong> {{ __("Email") }}: </strong> {{ $tenant->email }}
                    </li>
                    <li>
                        <strong> {{ __("Active") }}: </strong> {{ $tenant->active == 'Y' ? __('yes') : __('no') }}
                    </li>
                    <li>
                        <strong> {{ __("UUID") }}: </strong> {{ $tenant->uuid}}
                    </li>
                    <li>
                        <strong> {{ __("Created At") }}: </strong> {{ $tenant->created }}
                    </li>
                    <li>
                        <strong> {{ __("Updated At") }}: </strong> {{ $tenant->updated}}
                    </li>
                </ul>
            </div>

            <div class="card-footer">
                @include('admin.includes.button_delete', [
                'pathDelete' => route('tenants.destroy', $tenant->id)
                ])
            </div>
        </div>
    @stop
