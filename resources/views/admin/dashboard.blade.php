@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="admin-dashboard">
        <div class="row">
            <div class="col-md-3">
                <a href="{{ route('admin.active.accounts') }}">
                    <div class="panel widget bg-purple">
                        <div class="row row-table">
                            <div class="col-xs-4 bg-purple-dark text-center pv-lg"><i class="fa fa-user fa-3x"></i></div>
                            <div class="col-xs-8">
                                <div class="huge">{{ $usersCount }}</div>
                                <span>{{ str_plural('Member', $usersCount) }}</span>
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
                                <div class="huge">{{ $tasksCount }}</div>
                                <span>{{ str_plural('Task', $tasksCount) }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('admin.active.groups') }}">
                    <div class="panel widget bg-red">
                        <div class="row row-table">
                            <div class="col-xs-4 bg-red-dark text-center pv-lg"><i class="fa fa-users fa-3x"></i></div>
                            <div class="col-xs-8">
                                <div class="huge">{{ $groupsCount }}</div>
                                <span>{{ str_plural('Group', $groupsCount) }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('admin.notifications.all') }}">
                    <div class="panel widget bg-yellow">
                        <div class="row row-table">
                            <div class="col-xs-4 bg-yellow-dark text-center pv-lg"><i class="fa fa-bell fa-3x"></i></div>
                            <div class="col-xs-8">
                                <div class="huge">{{ $notificationCount }}</div>
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
    </div>
@stop

@section('footer')
    <script>
        (function() {
            var ctx = $('#dashboard-line-chart').get(0).getContext('2d');
            var chart = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "My First dataset",
                        fillColor: "rgba(220,220,220,0.5)",
                        strokeColor: "rgba(220,220,220,0.8)",
                        highlightFill: "rgba(220,220,220,0.75)",
                        highlightStroke: "rgba(220,220,220,1)",
                        data: [65, 59, 80, 81, 56, 55, 40]
                    },
                    {
                        label: "My Second dataset",
                        fillColor: "rgba(26,179,148,0.5)",
                        strokeColor: "rgba(26,179,148,0.8)",
                        highlightFill: "rgba(26,179,148,0.75)",
                        highlightStroke: "rgba(26,179,148,1)",
                        data: [28, 48, 40, 19, 86, 27, 90]
                    }
                ]
            };

            new Chart(ctx).Line(chart, {
                bezierCurve : false,
                scaleBeginAtZero: true,
                scaleShowGridLines: true,
                scaleGridLineColor: "rgba(0,0,0,.05)",
                scaleGridLineWidth: 1,
                barShowStroke: true,
                barStrokeWidth: 2,
                barValueSpacing: 5,
                barDatasetSpacing: 1
            });
        })();

        (function() {
            var ctx = $('#dashboard-bar-chart').get(0).getContext('2d');
            var data = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "My First dataset",
                        fillColor: "rgba(220,220,220,0.5)",
                        strokeColor: "rgba(220,220,220,0.8)",
                        highlightFill: "rgba(220,220,220,0.75)",
                        highlightStroke: "rgba(220,220,220,1)",
                        data: [65, 59, 80, 81, 56, 55, 40]
                    },
                    {
                        label: "My Second dataset",
                        fillColor: "rgba(26,179,148,0.5)",
                        strokeColor: "rgba(26,179,148,0.8)",
                        highlightFill: "rgba(26,179,148,0.75)",
                        highlightStroke: "rgba(26,179,148,1)",
                        data: [28, 48, 40, 19, 86, 27, 90]
                    }
                ]
            };
            
            new Chart(ctx).Bar(data, {
                scaleBeginAtZero: true,
                scaleShowGridLines: true,
                scaleGridLineColor: "rgba(0,0,0,.05)",
                scaleGridLineWidth: 1,
                barShowStroke: true,
                barStrokeWidth: 2,
                barValueSpacing: 5,
                barDatasetSpacing: 1
            });
        })();
    </script>
@stop

