@extends('layouts.admin')

@section('title', 'Published Tasks')

@section('content')
    <div class="admin-contents-wrapper">
        @if($tasks->isEmpty())
            <div class="well text-center">Currently, there is no published task available.</div>
        @else
            <div class="well">
                <div class="huge text-center">{{ $tasks->total() }} published {{ str_plural('task', $tasks->total()) }}</div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>{!! sort_tasks_by('id', 'ID') !!}</th>
                        <th>{!! sort_tasks_by('created_at', 'Created') !!}</th>
                        <th>Author</th>
                        <th>{!! sort_tasks_by('title', 'Title') !!}</th>
                        <th>Priority</th>
                        <th>{!! sort_tasks_by('starting_date', 'Starting') !!}</th>
                        <th>{!! sort_tasks_by('finishing_date', 'Ending') !!}</th>
                        <th data-original-title="999" data-container="body"
                            data-toggle="tooltip" data-placement="top" title="Is this task associated with an assignment?">
                            {!! sort_tasks_by('is_assigned', 'A?') !!}
                        </th>
                        <th data-original-title="999" data-container="body"
                            data-toggle="tooltip" data-placement="top" title="Is this task completed?">
                            {!! sort_tasks_by('completed', 'C?') !!}
                        </th>
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
                                    <a href="{{ route('admin::tasks.published.show', $task) }}" class="btn btn-primary btn-circle"
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
