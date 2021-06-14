@extends('adminlte::page')

@section('title', __('User Profile'))

@section('content_header')
    {{ Breadcrumbs::render('usersProfile') }}
    <h1> {{ __('User Profile') }} </h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            @include('admin.pages.users._partials.resume_profile')
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                        <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            @include('admin.pages.users._partials.posts')
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="timeline">
                            <!-- The timeline -->
                            @include('admin.pages.users._partials.timeline')
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="settings">
                            @include('admin.pages.users._partials.my_profile')
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
