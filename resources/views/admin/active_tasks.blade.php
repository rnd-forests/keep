@extends('layouts.admin')

@section('title', 'Manage Tasks')

@section('content')
    <div class="admin-contents-wrapper">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading"><i class="fa fa-area-chart"></i> Current number of tasks</div>
                    <div class="panel-body">
                        <div class="huge text-center">{{ $tasksCount }} published tasks</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Active Tasks Table</div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Created Date</th>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Starting</th>
                        <th>Ending</th>
                        <th>Completed</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->id }}</td>
                            <td class="text-center">{{ $task->present()->formatTime($task->created_at) }}</td>
                            <td class="text-center">{{ $task->owner->name }}</td>
                            <td class="text-navy">{{ $task->title }}</td>
                            <td class="text-center">{{ $task->present()->formatTime($task->starting_date) }}</td>
                            <td class="text-center">{{ $task->present()->formatTime($task->finishing_date) }}</td>
                            <td class="text-center">{!! $task->present()->printStatus($task->completed) !!}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.task.show', $task->slug) }}" class="btn btn-primary btn-circle"
                                   data-toggle="tooltip" data-placement="bottom" title="Show Task">
                                    <i class="fa fa-arrow-right"></i>
                                </a>
                                @include('admin.tasks.delete_form')
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="panel-footer">
                <div class="text-center">{!! $tasks->render() !!}</div>
            </div>
        </div>
    </div>
@stop
