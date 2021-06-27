@extends('adminlte::page')

@section('title', __('User Profile'))

@section('content_header')
    {{ Breadcrumbs::render('usersProfile') }}
    <h1> {{ __('User Profile') }} </h1>
@stop

@section('content')
    <div id="app" class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            @include('admin.pages.users._partials.resume_profile')
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">{{__('My data')}}</a></li>
                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">{{__("My addresses")}}</a></li>
                        {{-- <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li> --}}
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="settings">
                            @include('admin.pages.users._partials.form', [
                                'user' => $user
                            ])
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="timeline">
                            <!-- The timeline -->
                            {{-- @include('admin.pages.users._partials.timeline') --}}
                            <addresses-user></addresses-user>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="activity">
                            {{-- @include('admin.pages.users._partials.posts') --}}
                        </div>
                        <!-- /.tab-pane -->

                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
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