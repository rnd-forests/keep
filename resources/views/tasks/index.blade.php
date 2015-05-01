@extends('layouts.app')

@section('title')
    {{ $user->name }} - Tasks
@stop

@section('content')
    <div class="row">
        @foreach($tasks as $task)
            <li><a href="{{ route('users.tasks.show', [$user, $task]) }}">{{ $task->title }}</a></li>
        @endforeach
    </div>
@stop
