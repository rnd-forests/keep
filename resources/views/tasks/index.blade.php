@extends('layouts.app')

@section('title')
    {{ $user->name }} - Tasks
@stop

@section('content')
    <div class="row">
        @foreach($tasks as $task)
            {{ var_dump($task) }}
        @endforeach
    </div>
@stop
