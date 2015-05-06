@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        @foreach($tasks as $task)
            <li><a href="{{ route('users.tasks.show', [$user, $task]) }}">{{ $task->title }}</a></li>
        @endforeach
    </div>
@stop