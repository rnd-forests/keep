@extends('layouts.app')

@section('meta-description', 'Task scheduler of ' . Auth::user()->name)

@section('title', 'Tasks Scheduler')

@section('content')
    <div id="wrapper">
        <div id="user-task-scheduler"></div>
    </div>
@stop

@section('footer')
    <script>
        Keep.scheduler.forEach(function(task) {
            task.startDate = new Date(task.startDate);
            task.endDate = new Date(task.endDate);
            switch(task.color) {
                case 1:
                    task.color = "#ed5565";
                    break;
                case 2:
                    task.color = "#f9b66d";
                    break;
                case 3:
                    task.color = "#1dc5a3";
                    break;
                case 4:
                    task.color = "#1c84c6";
                    break;
            }
        });

        YUI().use(
            'aui-scheduler',
            function(Y) {
                var events = Keep.scheduler;
                var agendaView = new Y.SchedulerAgendaView();
                var dayView = new Y.SchedulerDayView();
                var monthView = new Y.SchedulerMonthView();
                var weekView = new Y.SchedulerWeekView();

                new Y.Scheduler({
                    activeView: monthView,
                    boundingBox: '#user-task-scheduler',
                    items: events,
                    render: true,
                    views: [dayView, weekView, monthView, agendaView]
                });
            }
        );
    </script>
@stop