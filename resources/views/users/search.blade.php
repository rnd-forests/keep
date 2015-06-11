@extends('layouts.app')

@section('title', 'Search results for ' . '- ' . $pattern . ' -')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="well"><span class="text-navy">{{ $tasks->total() }}</span> {{ str_plural('task', $tasks->total()) }} found for
                <strong class="text-danger">{{ $pattern }}</strong> (searched by titles)
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