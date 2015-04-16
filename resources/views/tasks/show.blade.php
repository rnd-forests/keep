@extends('layouts.app')

@section('title')
    {{ $task->title }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('tasks.partials.task')
            <div class="text-center">
                @include('tasks.partials.complete_form')
            </div>
            <div class="task-controls text-center">
                <a href="{{ route('users.tasks.index', $user->slug) }}">
                    <button class="btn btn-circle btn-info"
                        data-toggle="tooltip" data-placement="bottom" title="Back to tasks list">
                        <i class="fa fa-arrow-left"></i>
                    </button>
                </a>
                <a href="{{ route('users.tasks.edit', array($user->slug, $task->slug)) }}">
                    <button class="btn btn-circle btn-primary"
                        data-toggle="tooltip" data-placement="bottom" title="Edit task">
                        <i class="fa fa-pencil"></i>
                    </button>
                </a>
                @include('tasks.partials.delete_form')
            </div>
        </div>
    </div>
@stop
