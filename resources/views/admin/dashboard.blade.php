@extends('layouts.admin')
@section('title', 'Admin Dashboard')
@section('content')
    <div class="admin-dashboard">
        <div class="row">
            <div class="col-md-3">
                <a href="{{ route('admin::members.active') }}">
                    <div class="panel widget bg-purple">
                        <div class="row row-table">
                            <div class="col-xs-4 bg-purple-dark text-center pv-lg">
                                <i class="fa fa-user fa-3x"></i>
                            </div>
                            <div class="col-xs-8">
                                <div class="huge">{{ $userCount }}</div>
                                <span>{{ str_plural('Member', $userCount) }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('admin::tasks.published') }}">
                    <div class="panel widget bg-green">
                        <div class="row row-table">
                            <div class="col-xs-4 bg-green-dark text-center pv-lg">
                                <i class="fa fa-tasks fa-3x"></i>
                            </div>
                            <div class="col-xs-8">
                                <div class="huge">{{ $taskCount }}</div>
                                <span>{{ str_plural('Task', $taskCount) }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('admin::groups.active') }}">
                    <div class="panel widget bg-red">
                        <div class="row row-table">
                            <div class="col-xs-4 bg-red-dark text-center pv-lg">
                                <i class="fa fa-users fa-3x"></i>
                            </div>
                            <div class="col-xs-8">
                                <div class="huge">{{ $groupCount }}</div>
                                <span>{{ str_plural('Group', $groupCount) }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('admin::notifications.all') }}">
                    <div class="panel widget bg-yellow">
                        <div class="row row-table">
                            <div class="col-xs-4 bg-yellow-dark text-center pv-lg">
                                <i class="fa fa-bell fa-3x"></i>
                            </div>
                            <div class="col-xs-8">
                                <div class="huge">{{ $notificationCount }}</div>
                                <span>Notifications</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@stop