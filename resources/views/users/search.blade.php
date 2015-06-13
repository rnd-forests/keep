@extends('layouts.app')
@section('title', 'Search Results')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="well">
                {{ plural('task', $tasks->total()) }} found for
                <strong class="text-danger">{{ $pattern }}</strong>
            </div>
            <div class="list-group">
                @foreach($tasks as $task)
                    <a href="{{ route('member::tasks.show', [$user, $task]) }}" class="list-group-item">{{ $task->title }}</a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="text-center">{!! $tasks->appends(['q' => $pattern])->render() !!}</div>
@stop