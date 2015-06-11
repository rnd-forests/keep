@extends('layouts.app')

@section('meta-description', Auth::user()->name . ' personal dashboard')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div id="search-keyword-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header text-center text-warning">Wrong searching pattern</div>
                    <div class="modal-body text-center">Your searching keyword cannot be blank. Try another keyword.</div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-md-offset-3">
            {!! Form::open(['method' => 'GET', 'route' => ['member::tasks.search', Auth::user()], 'id' => 'search-form']) !!}
                <div class="form-group has-feedback">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-search"></span></span>
                        {!! Form::input('search', 'q', null, [
                            'id' => 'keyword',
                            'data-toggle' => 'popover',
                            'data-placement' => 'bottom',
                            'data-content' => 'Searching pattern cannot be blank.',
                            'class' => 'form-control input-lg',
                            'placeholder' => 'Search tasks...'
                        ]) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="row user-dashboard">
        <div class="col-md-3">
            <div class="panel panel-danger">
                <div class="panel-heading"><i class="fa fa-bookmark"></i> Urgent Tasks</div>
                <div class="list-group">
                    @foreach($urgentTasks as $task)
                        <a class="list-group-item" href="{{ route('member::tasks.show', [$user, $task]) }}">
                            <h5>{{ $task->title }}</h5>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading"><i class="fa fa-check"></i> Recently Completed Tasks</div>
                <div class="list-group">
                    @foreach($recentlyCompletedTasks as $task)
                        <a class="list-group-item" href="{{ route('member::tasks.show', [$user, $task]) }}">
                            <h5>{{ $task->title }}</h5>
                            <h6 class="text-info">completed {{ $task->present()->formatTimeForHumans($task->finished_at) }}</h6>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-6">
            @unless($totalTasksCount == 0)
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="text-center"><i class="fa fa-bar-chart"></i> Task Statistics</div>
                    </div>
                    <div class="panel-body">
                        <canvas id="user-dashboard-stats" width="520" height="320"></canvas>
                    </div>
                </div>
            @endunless

            <div class="row stats">
                <div class="col-md-3">
                    <a href="{{ route('member::tasks.all', $user) }}">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="large">{{ $totalTasksCount }}</div>
                                <div class="small">in total</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('member::tasks.completed', $user) }}">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="large">{{ $completedTasksCount }}</div>
                                <div class="small">completed</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('member::tasks.failed', $user) }}">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="large">{{ $failedTasksCount }}</div>
                                <div class="small">failed</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('member::tasks.due', $user) }}">
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
                    @foreach($newestTasks as $task)
                        <a href="{{ route('member::tasks.show', [$user, $task]) }}" class="list-group-item">
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
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-warning">
                <div class="panel-heading"><i class="fa fa-bomb"></i> Deadline Tasks</div>
                <div class="list-group">
                    @foreach($deadlineTasks as $task)
                        <a class="list-group-item" href="{{ route('member::tasks.show', [$user, $task]) }}">
                            <h5>{{ $task->title }}</h5>
                            <h6 class="text-warning">{{ $task->present()->getRemainingDays($task->finishing_date) }}</h6>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="panel panel-warning">
                <div class="panel-heading"><i class="fa fa-times"></i> Recently Failed Tasks</div>
                <div class="list-group">
                    @foreach($recentlyFailedTasks as $task)
                        <a class="list-group-item" href="{{ route('member::tasks.show', [$user, $task]) }}">
                            <h5>{{ $task->title }}</h5>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
    @unless($totalTasksCount == 0)
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
                    barValueSpacing : 50
                });
            })();
        </script>
    @endunless
    <script>
        (function() {
            var search_box, search_form;
            search_form = $('#search-form');
            search_box = $('#keyword');
            search_box.on("input", function() {
                var input;
                input = $.trim($(this).val());
                if (!input || input.length === 0) {
                    return $(this).popover('toggle');
                } else {
                    return $(this).popover('hide');
                }
            });

            search_form.on("submit", function() {
                var input;
                input = $.trim(search_box.val());
                if (!input || input.length === 0) {
                    $('#search-keyword-modal').modal("show");
                    search_box.popover('hide');
                    return false;
                }
            });
        })();
    </script>
@stop
