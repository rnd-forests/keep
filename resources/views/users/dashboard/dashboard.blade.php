@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="row user-dashboard">
        <div class="col-md-3">
            <div class="panel panel-danger">
                <div class="panel-heading"><i class="fa fa-bookmark"></i> Urgent Tasks</div>
                <div class="list-group">
                    @foreach($urgentTasks as $task)
                        <a class="list-group-item" href="{{ route('users.tasks.show', [$user, $task]) }}">
                            <h5>{{ $task->title }}</h5>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="panel panel-warning">
                <div class="panel-heading"><i class="fa fa-bomb"></i> Deadline Tasks</div>
                <div class="list-group">
                    @foreach($deadlineTasks as $task)
                        <a class="list-group-item" href="{{ route('users.tasks.show', [$user, $task]) }}">
                            <h5>{{ $task->title }}</h5>
                            <h6 class="text-warning">{{ $task->present()->getRemainingDays($task->finishing_date) }}</h6>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="text-center"><i class="fa fa-bar-chart"></i> Task Statistics</div>
                </div>
                <div class="panel-body">
                    <canvas id="user-dashboard-stats" width="520" height="320"></canvas>
                </div>
            </div>

            <div class="row stats">
                <div class="col-md-3">
                    <a href="{{ route('users.dashboard.all.tasks', $user) }}">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="large">{{ $totalTasksCount }}</div>
                                <div class="small">in total</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('users.dashboard.completed.tasks', $user) }}">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="large">{{ $completedTasksCount }}</div>
                                <div class="small">completed</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('users.dashboard.failed.tasks', $user) }}">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="large">{{ $failedTasksCount }}</div>
                                <div class="small">failed</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('users.dashboard.due.tasks', $user) }}">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="large">{{ $dueTasksCount }}</div>
                                <div class="small">due</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="panel panel-primary newest-tasks-wrapper">
                <div class="panel-heading">
                    <div class="text-center"><i class="fa fa-calendar"></i> Newest Tasks</div>
                </div>
                <div class="list-group">
                    @foreach($newestTasks->load('priority') as $task)
                        <a href="{{ route('users.tasks.show', [$user, $task]) }}" class="list-group-item">
                            <h5 class="text-center">{{ $task->title }}</h5>
                            <div class="task-labels">
                                <span class="label label-info">{{ $task->present()->formatTimeForHumans($task->created_at) }}</span>
                                @if ($task->completed)
                                    <span class="label label-info">completed</span>
                                @else
                                    <span class="label label-danger">uncompleted</span>
                                @endif
                                @if($task->is_failed)
                                    <span class="label label-danger">failed</span>
                                @endif
                                <span class="label label-info">{{ $task->priority->name }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-info">
                <div class="panel-heading"><i class="fa fa-check"></i> Recently Completed Tasks</div>
                <div class="list-group">
                    @foreach($recentlyCompletedTasks as $task)
                        <a class="list-group-item" href="{{ route('users.tasks.show', [$user, $task]) }}">
                            <h5>{{ $task->title }}</h5>
                            <h6 class="text-info">completed {{ $task->present()->formatTimeForHumans($task->finished_at) }}</h6>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="panel panel-warning">
                <div class="panel-heading"><i class="fa fa-times"></i> Recently Failed Tasks</div>
                <div class="list-group">
                    @foreach($recentlyFailedTasks as $task)
                        <a class="list-group-item" href="{{ route('users.tasks.show', [$user, $task]) }}">
                            <h5>{{ $task->title }}</h5>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
    <script>
        (function () {
            var ctx = document.getElementById('user-dashboard-stats').getContext('2d');
            var chart = {
                labels: ["Completed", "Failed", "Due"],
                datasets: [{
                    data: [
                        Math.round({{ json_encode($completedTasksCount / $totalTasksCount * 100) }}),
                        Math.round({{ json_encode($failedTasksCount / $totalTasksCount) * 100 }}),
                        Math.round({{ json_encode(($totalTasksCount - $completedTasksCount - $failedTasksCount) / $totalTasksCount) * 100 }})
                    ],
                    fillColor: "rgba(26,179,148,0.5)",
                    strokeColor: "rgba(26,179,148,0.8)",
                    highlightFill: "rgba(26,179,148,0.75)",
                    highlightStroke: "rgba(26,179,148,1)"
                }]
            };

            new Chart(ctx).Bar(chart, {
                scaleBeginAtZero: true,
                scaleShowGridLines: true,
                scaleGridLineColor: "rgba(0,0,0,.05)",
                scaleGridLineWidth: 1,
                barShowStroke: true,
                barStrokeWidth: 2,
                barDatasetSpacing: 1,
                responsive: true,
                barValueSpacing : 50
            });
        })();
    </script>
@stop
