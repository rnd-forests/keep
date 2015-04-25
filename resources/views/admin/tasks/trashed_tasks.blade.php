@extends('layouts.admin')

@section('title', 'Trashed Tasks')

@section('content')
    <div class="admin-contents-wrapper">
        @if ($trashedTasks->isEmpty())
            <div class="well text-center">Currently, there is no trashed task.</div>
        @else
            <div class="well">
                <div class="huge text-center">{{ $trashedTasks->count() }} trashed {{ str_plural('task', $trashedTasks->count()) }}</div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Deleted</th>
                        <th>Deleted by</th>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Priority</th>
                        <th>Starting</th>
                        <th>Ending</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($trashedTasks as $task)
                            <tr>
                                <td>{{ $task->id }}</td>
                                <td>{{ $task->present()->formatTime($task->deleted_at) }}</td>
                                <td>{{ $task->destroyer->name }}</td>
                                @if(isset($task->owner))
                                    <td>{{ $task->owner->name }}</td>
                                @else
                                    <td class="text-navy">Administrator</td>
                                @endif
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->priority->name }}</td>
                                <td>{{ $task->present()->formatTime($task->starting_date) }}</td>
                                <td>{{ $task->present()->formatTime($task->finishing_date) }}</td>
                                <td>
                                    @include('admin.tasks.partials.restore_form')
                                    @include('admin.tasks.partials.force_delete_form')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <div class="text-center">{!! $trashedTasks->render() !!}</div>
    </div>
@stop
