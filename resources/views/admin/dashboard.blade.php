@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="admin-dashboard">
        <div class="row">
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
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard Line Chart</div>
                    <div class="panel-body">
                        <canvas id="dashboard-line-chart" width="510" height="320"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard Bar Chart</div>
                    <div class="panel-body">
                        <canvas id="dashboard-bar-chart" width="510" height="320"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard Radar Chart</div>
                    <div class="panel-body">
                        <canvas id="dashboard-radar-chart" width="310" height="310"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard Doughnut Chart</div>
                    <div class="panel-body">
                        <canvas id="dashboard-doughnut-chart" width="310" height="310"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard Polar Area Chart</div>
                    <div class="panel-body">
                        <canvas id="dashboard-polar-chart" width="310" height="310"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

