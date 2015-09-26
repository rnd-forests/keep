@extends('layouts.admin')
@section('title', 'Published Tasks')
@section('content')
    <div class="admin-contents-wrapper">
        @if(blank($tasks))
            <div class="well text-center">No published task available.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>{!! sort_tasks_by('id', 'ID') !!}</th>
                        <th>{!! sort_tasks_by('created_at', 'Created') !!}</th>
                        <th>Author</th>
                        <th>{!! sort_tasks_by('title', 'Title') !!}</th>
                        <th>Priority</th>
                        <th>{!! sort_tasks_by('starting_date', 'Starting') !!}</th>
                        <th>{!! sort_tasks_by('finishing_date', 'Ending') !!}</th>
                        <th>{!! sort_tasks_by('completed', 'Completed?') !!}</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks->chunk(10) as $taskStack)
                            @foreach($taskStack as $task)
                                <tr>
                                    <td>{{ $task->id }}</td>
                                    <td>{{ short_time($task->created_at) }}</td>
                                    @if(isset($task->owner))
                                        <td>{{ $task->owner->name }}</td>
                                    @else
                                        <td class="text-navy">Admin</td>
                                    @endif
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->priority->name }}</td>
                                    <td>{{ short_time($task->starting_date) }}</td>
                                    <td>{!! short_time($task->finishing_date) !!}</td>
                                    <td>{!! $task->present()->printStatus($task->completed) !!}</td>
                                    <td>
                                        <a href="{{ route('admin::tasks.show', $task) }}"
                                           class="btn btn-primary btn-sm"
                                           data-toggle="tooltip"
                                           data-placement="bottom"
                                           title="Show Task">
                                            <i class="fa fa-arrow-right"></i>
                                        </a>
                                        @include('admin.tasks.partials._delete_form')
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
            {!! render_pagination($tasks) !!}
        @endif
    </div>
@stop
