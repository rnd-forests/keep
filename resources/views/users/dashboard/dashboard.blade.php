@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    @inject('counter', 'Keep\Services\UserDashboardService')
    @include('users.dashboard.partials._search_form')
    <div class="row user-dashboard">
        <div class="col-md-3">
            @include('users.dashboard.partials._urgent')
            @include('users.dashboard.partials._completed')
        </div>
        <div class="col-md-6">
            @include('users.dashboard.partials._counters')
            @include('users.dashboard.partials._chart')
        </div>
        <div class="col-md-3">
            @include('users.dashboard.partials._deadline')
        </div>
    </div>
@stop

@section('footer')
    <script>
        @unless(zero($counter->totalTasks()))
            (function () {
                var ctx = document.getElementById('user-dashboard-stats').getContext('2d');
                var chart = {
                    labels: ["Completed", "Failed", "Processing"],
                    datasets: [{
                        data: [
                            Math.round({{ json_encode($counter->countCompletedTasks() / $counter->totalTasks() * 100) }}),
                            Math.round({{ json_encode($counter->countFailedTasks() / $counter->totalTasks() * 100) }}),
                            Math.round({{ json_encode($counter->countDueTasks() / $counter->totalTasks() * 100) }})
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
        @endunless

        // Search form
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
