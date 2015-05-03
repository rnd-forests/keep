@extends('layouts.app')

@section('title')
    {{ $user->name }} - {{ $group->name }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="page-header"><h3>Members</h3></div>
            @foreach($group->users as $user)
                <div class="well">
                    <div class="media">
                        <div class="media-left">
                            @include('users.partials.avatar')
                        </div>
                        <div class="media-body">
                            <h5 class="media-heading">{{ $user->name  }}</h5>
                            <p>{{ $user->email }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-8">
            <div class="page-header"><h3>Assignments</h3></div>
            @foreach($group->assignments->load('task.priority') as $assignment)
                <div class="task-wrapper">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <a class="task-title">{{ $assignment->assignment_name }}</a>
                            <h6 class="task-time-ago">{{ $assignment->present()->formatTimeForHumans($assignment->created_at) }}</h6>
                        </div>
                        <div class="panel-body">
                            <div class="well text-center">
                                <h6 style="margin: 0">Associated Task</h6>
                                <h4 style="margin: 0">{{ $assignment->task->title }}</h4>
                            </div>
                            <div class="well">{{ $assignment->task->content }}</div>
                            <div class="task-labels">
                                <span class="label label-primary">{{ $assignment->task->present()->getRemainingDays($assignment->task->finishing_date) }}</span>
                                <span class="label label-info">{{ $assignment->task->priority->name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@stop