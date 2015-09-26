@extends('layouts.admin')
@section('title', $task->title)
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="task-wrapper">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h4>{{ $task->title }}</h4>
                        <h6 class="task-time-ago">
                            {{ humans_time($task->created_at) }}
                        </h6>
                    </div>
                    <div class="panel-body">
                        <div class="task-labels">
                            <span class="label label-default">
                                {{ short_time($task->starting_date) }} to {{ short_time($task->finishing_date) }}
                            </span>
                            <span class="label label-default">
                                {{ remaining_days($task->finishing_date) }}
                            </span>
                            <span class="label label-warning">
                                {{ $task->priority->name }}
                            </span>
                        </div>
                        <div class="well">{!! $task->content !!}</div>
                        @unless (empty($task->location))
                            <div class="well">
                                <i class="fa fa-map-marker"></i>
                                <strong>{{ $task->location }}</strong>
                            </div>
                        @endunless
                        @unless (blank($task->tags))
                            <div class="well">
                                <i class="fa fa-tags"></i>
                                @foreach($task->tags as $tag)
                                    <span class="label label-default">
                                        {{ $tag->name }}
                                    </span>
                                @endforeach
                            </div>
                        @endunless
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop