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
                                <div class="modal fade" id="delete-task-modal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete this task? Once your task is deleted,
                                                    it cannot be recovered. Be careful!</p>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="text-center">
                                                    {!! Form::delete(route('users.tasks.destroy', [$user->slug, $task->slug]),
                                                        'Confirm', ['class' => 'btn btn-danger']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('users.tasks.edit', array($user->slug, $task->slug)) }}" class="task-action">
                                    <i class="fa fa-wrench"></i> Update
                                </a>
                                <a class="task-action" data-toggle="modal" data-target="#delete-task-modal">
                                    <i class="fa fa-trash-o"></i>Delete
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="text-center">{!! $tasks->render() !!}</div>
            </div>
        </div>
    </div>
@stop
