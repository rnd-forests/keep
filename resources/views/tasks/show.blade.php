@extends('layouts.app')

@section('title')
    {{ $task->title }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('tasks.partials.task')
        </div>
    </div>
@stop
