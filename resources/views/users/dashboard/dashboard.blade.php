@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    @inject('counter', 'Keep\Services\UserDashboardService')
    <div class="col-md-10 col-md-offset-1 user-dashboard">
        <div class="col-md-6">
            @include('users.dashboard.partials._urgent')
            @include('users.dashboard.partials._deadline')
            @include('users.dashboard.partials._completed')
        </div>
        <div class="col-md-6">
            @include('users.dashboard.partials._search_form')
            @include('users.dashboard.partials._chart')
            @include('users.dashboard.partials._counters')
        </div>
    </div>
@stop

@section('footer')
    <script>
        @unless(zero($counter->totalTasks()))
            $(function() {
                Keep.charts.showUserDashboardChart(
                    {{ $counter->countCompletedTasks() }},
                    {{ $counter->countFailedTasks() }},
                    {{ $counter->countDueTasks() }},
                    {{ $counter->totalTasks() }}
                );
            });
        @endunless
    </script>
@stop
