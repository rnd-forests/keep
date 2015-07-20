@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    @inject('counter', 'Keep\Services\UserDashboard')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @include('users.dashboard.partials._search_form')
        </div>
    </div>
    <div class="row user-dashboard">
        <div class="col-md-3">
            <div class="panel panel-danger">
                <div class="panel-heading">Urgent Tasks</div>
                <div class="list-group">
                    @foreach($urgentTasks as $task)
                        <a class="list-group-item" href="{{ route('member::tasks.show', [$user, $task]) }}">
                            <h5>{{ $task->title }}</h5>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">Recently Completed Tasks</div>
                <div class="list-group">
                    @foreach($recentlyCompletedTasks as $task)
                        <a class="list-group-item" href="{{ route('member::tasks.show', [$user, $task]) }}">
                            <h5>{{ $task->title }}</h5>
                            <h6 class="text-info">completed {{ humans_time($task->finished_at) }}</h6>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-6">
            @unless(zero($counter->totalTasks()))
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
                                <div class="large">{{ $counter->totalTasks() }}</div>
                                <div class="small">in total</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('member::tasks.completed', $user) }}">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="large">{{ $counter->countCompletedTasks() }}</div>
                                <div class="small">completed</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('member::tasks.failed', $user) }}">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="large">{{ $counter->countFailedTasks() }}</div>
                                <div class="small">failed</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('member::tasks.due', $user) }}">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="large">{{ $counter->countDueTasks() }}</div>
                                <div class="small">due</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-warning">
                <div class="panel-heading">Deadline Tasks</div>
                <div class="list-group">
                    @foreach($deadlineTasks as $task)
                        <a class="list-group-item" href="{{ route('member::tasks.show', [$user, $task]) }}">
                            <h5>{{ $task->title }}</h5>
                            <h6 class="text-warning">{{ remaining_days($task->finishing_date) }}</h6>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
    @unless(zero($counter->totalTasks()))
        <script>
            (function () {
                var ctx = document.getElementById('user-dashboard-stats').getContext('2d');
                var chart = {
                    labels: ["Completed", "Failed", "Due"],
                    datasets: [{
                        data: [
                            Math.round({{ json_encode(
                                $counter->countCompletedTasks() / $counter->totalTasks() * 100
                            ) }}),
                            Math.round({{ json_encode(
                                $counter->countFailedTasks() / $counter->totalTasks() * 100
                            ) }}),
                            Math.round({{ json_encode(
                                $counter->countDueTasks() / $counter->totalTasks() * 100
                            ) }})
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
