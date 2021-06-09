@extends('adminlte::page')

@section('title', __("My Invoices"))

@section('content_header')
    {{ Breadcrumbs::render('usersInvoices') }}
    <h1> {{ __("My Invoices") }} </h1>
@stop

@section('content')
    <div class="card">

        @include('admin.includes.alerts')

        <div class="div card-header">
            @include('admin.includes.search', [
                'route' => null, 
                'add' => null
            ])
           
           <h5 class="badge badge-light float-lg-right"> {{ __("You are signing") }}: {{$user->plan()->name}}</h5>

            @if($subscription)
                @if($subscription->cancelled() && $subscription->onGracePeriod())
                    <a href="{{ route('subscriptions.resume') }}" class="btn btn-outline-info">
                        {{ __("Reactivate Subscription") }}
                    </a>
                    <span class="ml-2"> {{ __("Your access goes to") }}: {{$user->access_end}}</span>
                @elseif(!$subscription->cancelled())
                    <a href="{{ route('subscriptions.cancel') }}" class="btn btn-outline-danger">
                        {{ __("Unsubscribe") }} 
                    </a>
                @endif

                @if ($subscription->ended())
                    {{ __("He finished") }}
                @endif
            @else
                [{{ __("Non-subscriber") }}]
            @endif
        </div>

        <div class="div card-body table-responsive">
            <table class="table table-condensed table-dark table-striped table-hover table-borderless align-middle">
                <thead>
                    <tr>
                        <th>{{ __("Date") }}</th>
                        <th>{{ __("Value") }}</th>
                        <th>{{ __("Actions") }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->date()->toFormattedDateString() }}</td>
                            <td>{{ $invoice->total() }}</td>
                            <td>
                                @each('admin.includes.forms_actions', ['items' => 
                                    [
                                        'route' => route('subscriptions.invoice.download', $invoice->id), 
                                        'color' => 'info',
                                        'icon' => 'download',
                                        'label' => __("Download")
                                    ],

                                ], 'item', 'admin.includes.forms_actions')
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $invoices->appends($filters)->onEachSide(5)->links() !!}
            @else
                {{-- {!! $invoices->onEachSide(5)->links() !!} --}}
            @endif
        </div>
    </div>
@stop