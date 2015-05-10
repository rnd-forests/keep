@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="row user-dashboard">
        <div class="col-md-4">
            <div class="panel panel-danger">
                <div class="panel-heading"><i class="fa fa-bookmark"></i> Urgent Tasks</div>
                <div class="list-group urgent-tasks">
                    @foreach($urgentTasks as $task)
                        <a class="list-group-item" href="{{ route('users.tasks.show', [$user, $task]) }}">
                            <h5>{{ $task->title }}</h5>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="panel panel-warning">
                <div class="panel-heading"><i class="fa fa-bomb"></i> Deadline Tasks</div>
                <div class="list-group urgent-tasks">
                    @foreach($deadlineTasks as $task)
                        <a class="list-group-item" href="{{ route('users.tasks.show', [$user, $task]) }}">
                            <h5>{{ $task->title }}</h5>
                            <h6 class="text-warning">{{ $task->present()->getRemainingDays($task->finishing_date) }}</h6>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop