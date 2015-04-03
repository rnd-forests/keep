@extends('layouts.admin')

@section('title')
    Manage Tasks
@stop

@section('content')
    <div class="admin-contents-wrapper">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Current number of tasks</div>
                    <div class="panel-body">
                        <div class="huge text-center">{{ $taskCount }} published tasks</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">fsdfsdfsdfds</div>
                    <div class="panel-body">
                        <div class="huge text-center">{{ $userCount }} active accounts</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Manage tasks</div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Created Date</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Starting</th>
                        <th>Ending</th>
                        <th>Completed</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->present()->formatTaskTime($task->created_at) }}</td>
                            <td>{{ $task->title }}</td>
                            <td>{{ str_limit($task->content, $limit = 50, $end = '...') }}</td>
                            <td>{{ $task->present()->formatTaskTime($task->starting_date) }}</td>
                            <td>{{ $task->present()->formatTaskTime($task->finishing_date) }}</td>
                            <td>{{ $task->present()->printStatus($task->completed) }}</td>
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
