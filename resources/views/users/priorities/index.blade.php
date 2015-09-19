@extends('layouts.default')
@section('title', 'Priorities')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="list-group">
                <a class="list-group-item active">
                    <i class="fa fa-tags"></i> Priority Levels
                </a>
                @foreach($priorities as $priority)
                    <a class="list-group-item"
                       href="{{ route('member::priorities.task', [$user, $priority]) }}">
                        <span class="badge">
                            {{ plural('task', counting($priority->tasks()->where('user_id', $user->id)->get())) }}
                        </span>
                        {{ $priority->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@stop
