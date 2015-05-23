@extends('layouts.app')

@section('meta-description', 'Task scheduler of ' . Auth::user()->name)

@section('title', 'Task Scheduler')

@section('content')
    <div id="user-task-scheduler"></div>
@stop

@section('footer')
    <script>
        Keep.scheduler.forEach(function(task) {
            task.startDate = new Date(task.startDate);
            task.endDate = new Date(task.endDate);
        });

        YUI().use(
            'aui-scheduler',
            function(Y) {
                var events = Keep.scheduler;
                var agendaView = new Y.SchedulerAgendaView();
                var dayView = new Y.SchedulerDayView();
                var eventRecorder = new Y.SchedulerEventRecorder();
                var monthView = new Y.SchedulerMonthView();
                var weekView = new Y.SchedulerWeekView();

                new Y.Scheduler({
                    activeView: dayView,
                    boundingBox: '#user-task-scheduler',
                    eventRecorder: eventRecorder,
                    items: events,
                    render: true,
                    views: [dayView, weekView, monthView, agendaView]
                });
            }
        );
    </script>
@stop