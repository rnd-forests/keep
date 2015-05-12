@extends('layouts.app')

@section('title')
    {{ $task->title }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('users.tasks.partials.task')
            @unless($task->is_failed)
                <div class="text-center">
                    @include('users.tasks.partials.complete_form')
                </div>
            @endunless
            <div class="task-controls text-center">
                <a href="{{ route('users.dashboard', $user) }}">
                    <button class="btn btn-circle btn-info"
                        data-toggle="tooltip" data-placement="bottom" title="Back to dashboard">
                        <i class="fa fa-arrow-left"></i>
                    </button>
                </a>
                <a href="{{ route('users.tasks.edit', [$user, $task]) }}">
                    <button class="btn btn-circle btn-primary"
                        data-toggle="tooltip" data-placement="bottom" title="Edit task">
                        <i class="fa fa-pencil"></i>
                    </button>
                </a>
                @include('users.tasks.partials.delete_form')
            </div>
        </div>
    </div>
@stop
