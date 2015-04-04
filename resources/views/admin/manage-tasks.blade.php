@extends('layouts.admin')

@section('title')
    Manage Tasks
@stop

@section('content')
    <div class="admin-contents-wrapper">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading"><i class="fa fa-area-chart"></i> Current number of tasks</div>
                    <div class="panel-body">
                        <div class="huge text-center">{{ $taskCount }} published tasks</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">Tasks Table</div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Created Date</th>
                        <th>Title</th>
                        <th>Starting</th>
                        <th>Ending</th>
                        <th>Completed</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td class="text-center">{{ $task->present()->formatTaskTime($task->created_at) }}</td>
                            <td class="text-navy">{{ $task->title }}</td>
                            <td class="text-center">{{ $task->present()->formatTaskTime($task->starting_date) }}</td>
                            <td class="text-center">{{ $task->present()->formatTaskTime($task->finishing_date) }}</td>
                            <td class="text-center">{{ $task->present()->printStatus($task->completed) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <footer class="panel-footer">
                <div class="pull-right">{!! $tasks->render() !!}</div>
                <div class="clearfix"></div>
            </footer>
        </div>
    </div>
@stop
