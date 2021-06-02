@extends('adminlte::page')

@section('title', 'Minhas Faturas')

@section('content_header')
    {{ Breadcrumbs::render('usersInvoices') }}
    <h1>Minhas Faturas</h1>
@stop

@section('content')
    <div class="card">

        @include('admin.includes.alerts')

        <div class="div card-header">
            @include('admin.includes.search', [
                'route' => null, 
                'add' => null
            ])
           
           <h5 class="badge badge-light float-lg-right"> Você está assinando o {{$user->plan()->name}}</h5>

            @if($subscription)
                @if($subscription->cancelled() && $subscription->onGracePeriod())
                    <a href="{{ route('subscriptions.resume') }}" class="btn btn-outline-info">
                        Reativar Assinatura
                    </a>
                    <span class="ml-2"> Seu acesso vai até: {{$user->access_end}}</span>
                @elseif(!$subscription->cancelled())
                    <a href="{{ route('subscriptions.cancel') }}" class="btn btn-outline-danger">
                        Cancelar assinatura
                    </a>
                @endif

                @if ($subscription->ended())
                    Acabou
                @endif
            @else
                [Não assinante]
            @endif
        </div>

        <div class="div card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Valor</th>
                        <th>Ações</th>
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
                                        'label' => 'Baixar'
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