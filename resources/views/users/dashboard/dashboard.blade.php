@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    @inject('counter', 'Keep\Services\UserDashboardService')
    <div class="row user-dashboard">
        <div class="col-md-5">
            @include('users.dashboard.partials._search_form')
            @include('users.dashboard.partials._urgent')
            @include('users.dashboard.partials._deadline')
            @include('users.dashboard.partials._completed')
        </div>
        <div class="col-md-7">
            @include('users.dashboard.partials._chart')
            @include('users.dashboard.partials._counters')
        </div>
    </div>
@stop

@section('footer')
    <script>
        @unless(zero($counter->totalTasks()))
            (function () {
                var ctx = $("#user-dashboard-stats").get(0).getContext("2d");
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
                    scaleShowGridLines: true,
                    barValueSpacing: 60,
                    barShowStroke: true,
                    barStrokeWidth: 2
                });
            })();
        @endunless

        // Search form
        (function() {
            var search_form = $("#search-form");
            var search_box = $("#keyword");
            search_box.on("input", function() {
                var input = $.trim($(this).val());
                if (!input || input.length === 0) {
                    return $(this).popover("toggle");
                } else {
                    return $(this).popover("hide");
                }
            });

            search_form.on("submit", function() {
                var input = $.trim(search_box.val());
                if (!input || input.length === 0) {
                    $("#search-keyword-modal").modal("show");
                    search_box.popover("hide");
                    return false;
                }
            });
        })();
    </script>
@stop
