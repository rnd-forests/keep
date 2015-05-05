@extends('layouts.app')

@section('title')
    {{ $assignment->assignment_name }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="assignment-wrapper">
                <h2 class="assignment-name text-center">{{ $assignment->assignment_name }}</h2>
                <div class="page-header"><h5>Associated Task</h5></div>
                @include('tasks.partials.task', ['task' => $assignment->task])
            </div>
        </div>
    </div>
@stop