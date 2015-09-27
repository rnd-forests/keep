@extends('layouts.default')
@section('title', $type . ' Tasks')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="list-group">
                @unless(blank($tasks))
                    <div class="list-group-item active">
                        <div class="text-center">{{ $type }}</div>
                    </div>
                    @foreach($tasks as $task)
                        <a href="{{ route('member::tasks.show', [$user, $task]) }}" class="list-group-item">
                            <span class="badge">{{ humans_time($task->created_at) }}</span>
                            {{ $task->title }}
                        </a>
                    @endforeach
                @else
                    <div class="text-center text-warning">No {{ strtolower($type) }} tasks available.</div>
                @endunless
            </div>
            {!! paginate($tasks) !!}
        </div>
    </div>
@stop