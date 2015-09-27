@extends('layouts.admin')
@section('title', 'Trashed Tasks')
@section('content')
    <div class="admin-contents-wrapper">
        @if (blank($trashedTasks))
            <div class="text-center text-warning">No trashed task available.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Deleted</th>
                            <th>Author</th>
                            <th>Title</th>
                            <th>Priority</th>
                            <th>Starting</th>
                            <th>Ending</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trashedTasks->chunk(10) as $taskStack)
                            @foreach($taskStack as $task)
                                <tr>
                                    <td>{{ $task->id }}</td>
                                    <td>{{ short_time($task->deleted_at) }}</td>
                                    @if(isset($task->owner))
                                        <td>{{ $task->owner->name }}</td>
                                    @else
                                        <td class="text-navy">Admin</td>
                                    @endif
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->priority->name }}</td>
                                    <td>{{ short_time($task->starting_date) }}</td>
                                    <td>{{ short_time($task->finishing_date) }}</td>
                                    <td>
                                        @include('admin.tasks.partials._restore_form')
                                        @include('admin.tasks.partials._force_delete_form')
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        {!! paginate($trashedTasks) !!}
    </div>
@stop
