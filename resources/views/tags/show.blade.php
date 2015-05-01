@extends('layouts.app')

@section('title')
    Tags - {{ $tag->name }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="list-group">
                <a class="list-group-item active"><i class="fa fa-tag"></i> {{ $tag->name }}</a>
                @foreach($tasks as $task)
                    <a class="list-group-item" href="{{ route('users.tasks.show', [Auth::user(), $task]) }}">
                        <span class="badge">
                            {{ $task->present()->formatTimeForHumans($task->created_at) }}
                        </span>
                        {{ $task->title }}
                    </a>
                @endforeach
            </div>
            <div class="text-center">{!! $tasks->render() !!}</div>
        </div>
    </div>
@stop