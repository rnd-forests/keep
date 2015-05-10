@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="row user-dashboard">
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="label label-danger">Urgent Tasks</span></div>
                <div class="list-group urgent-tasks">
                    @foreach($urgentTasks as $task)
                        <a class="list-group-item" href="{{ route('users.tasks.show', [$user, $task]) }}">
                            {{ $task->title }}<span class="badge">{{ $task->present()->getRemainingDays($task->finishing_date) }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop