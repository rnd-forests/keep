@extends('layouts.admin')

@section('title')
    Dashboard
@stop

@section('content')
    <div class="row admin-dashboard">
        <div class="col-md-3">
            <a href="{{ route('admin.active.accounts') }}">
                <div class="panel widget bg-purple">
                    <div class="row row-table">
                        <div class="col-xs-4 bg-purple-dark text-center pv-lg"><i class="fa fa-users fa-3x"></i></div>
                        <div class="col-xs-8">
                            <div class="huge">{{ $userCount }}</div>
                            <span>Members</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('admin.manage.tasks') }}">
                <div class="panel widget bg-green">
                    <div class="row row-table">
                        <div class="col-xs-4 bg-green-dark text-center pv-lg"><i class="fa fa-tasks fa-3x"></i></div>
                        <div class="col-xs-8">
                            <div class="huge">{{ $taskCount }}</div>
                            <span>Tasks</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="#">
                <div class="panel widget bg-yellow">
                    <div class="row row-table">
                        <div class="col-xs-4 bg-yellow-dark text-center pv-lg"><i class="fa fa-bell fa-3x"></i></div>
                        <div class="col-xs-8">
                            <div class="huge">5689</div>
                            <span>Notifications</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="#">
                <div class="panel widget bg-red">
                    <div class="row row-table">
                        <div class="col-xs-4 bg-red-dark text-center pv-lg"><i class="fa fa-bell fa-3x"></i></div>
                        <div class="col-xs-8">
                            <div class="huge">369</div>
                            <span>Messages</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
@stop

