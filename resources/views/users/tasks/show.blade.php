@extends('layouts.app')
@section('meta-description', $task->title . ' (' . str_limit($task->content, 250) . ')')
@section('title', $task->title)
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('users.tasks.partials._task')
        </div>
    </div>
@stop
