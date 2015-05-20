@extends('layouts.admin')

@section('title', 'Published Tasks')

@section('content')
    <div class="admin-contents-wrapper">
        @if($tasks->isEmpty())
            <div class="well text-center">Currently, there is no published task available.</div>
        @else
            <div class="well">
                <div class="huge text-center">{{ $tasksCount }} published {{ str_plural('task', $tasksCount) }}</div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Created</th>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Priority</th>
                        <th>Starting</th>
                        <th>Ending</th>
                        <th data-original-title="999" data-container="body"
                            data-toggle="tooltip" data-placement="top" title="Is this task associated with an assignment?">A?</th>
                        <th data-original-title="999" data-container="body"
                            data-toggle="tooltip" data-placement="top" title="Is this task completed?">C?</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->id }}</td>
                                <td>{{ $task->present()->formatTime($task->created_at) }}</td>
                                @if(isset($task->owner))
                                    <td>{{ $task->owner->name }}</td>
                                @else
                                    <td class="text-navy">Administrator</td>
                                @endif
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->priority->name }}</td>
                                <td>{{ $task->present()->formatTime($task->starting_date) }}</td>
                                <td>{!! $task->present()->formatTime($task->finishing_date) !!}</td>
                                <td>{!! $task->present()->printStatus($task->is_assigned) !!}</td>
                                <td>{!! $task->present()->printStatus($task->completed) !!}</td>
                                <td>
                                    <a href="{{ route('admin.task.show', $task) }}" class="btn btn-primary btn-circle"
                                       data-toggle="tooltip" data-placement="bottom" title="Show Task">
                                        <i class="fa fa-arrow-right"></i>
                                    </a>
                                    @include('admin.tasks.partials.delete_form')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-center">{!! $tasks->render() !!}</div>
        @endif
    </div>
@stop
