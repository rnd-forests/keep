@extends('layouts.app')

@section('title')
    {{ $user->name }}'s Tasks
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="tasks-wrapper">
                @if($tasks->count() == 0)
                    <div class="well text-center">Currently, you have no tasks.</div>
                @else
                    <div class="well task-control">
                        <div class="text-center">
                            <a class="btn btn-success" href="{{ route('users.tasks.create', Auth::user()->slug) }}">
                                <i class="fa fa-plus" style="padding-right: 5px"></i>Add new task
                            </a>
                        </div>
                    </div>
                    @foreach($tasks as $task)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a class="task-title" href="{{ route('users.tasks.show', array($user->slug, $task->slug)) }}">{{ $task->title }}</a>
                                <h6 class="task-time-ago">{{ $task->present()->taskTimeForHumans($task->created_at) }}</h6>
                            </div>
                            <div class="panel-body">
                                <div class="task-labels">
                                    <span class="label">
                                        {{ $task->present()->formatTaskTime($task->starting_date) }} to
                                        {{ $task->present()->formatTaskTime($task->finishing_date) }}
                                    </span>
                                    <span class="label">{{ $task->present()->getRemainingDays($task->finishing_date) }}</span>
                                    @if ($task->completed)
                                        <span class="label label-success">Completed</span>
                                    @endif
                                </div>
                                <div class="well">{{ $task->content }}</div>
                                @unless (empty($task->location))
                                    <div class="well"><i class="fa fa-map-marker"></i><strong>{{ $task->location }}</strong></div>
                                @endif
                                @unless (empty($task->note))
                                    <div class="well"><i class="fa fa-pencil"></i><em>{{ $task->note }}</em></div>
                                @endif
                                @unless ($task->tags->isEmpty())
                                    <div class="well">
                                        <i class="fa fa-tags"></i>
                                        @foreach($task->tags as $tag)
                                            <span class="label label-primary">{{ $tag->name }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="panel-footer">
                                <a href="{{ route('users.tasks.edit', array($user->slug, $task->slug)) }}" class="task-action">
                                    <i class="fa fa-wrench"></i> Update
                                </a>
                                @include('tasks.partials.delete_form')
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="text-center">{!! $tasks->render() !!}</div>
            </div>
        </div>
    </div>
@stop
