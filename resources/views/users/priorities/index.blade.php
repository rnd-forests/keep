@extends('layouts.app')

@section('meta-description', 'All priority levels associated with tasks of ' . Auth::user()->name)

@section('title', 'Priority Levels')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="list-group">
                <a class="list-group-item active"><i class="fa fa-tags"></i> Priority Levels</a>
                @foreach($priorities as $priority)
                    <a class="list-group-item" href="{{ route('users.priority.tasks', [Auth::user(), $priority]) }}">
                        <span class="badge">
                            {{--*/ $counter = $priority->tasks()->where('user_id', $user->id)->count() /*--}}
                            {{ $counter }} {{ str_plural('task', $counter) }}
                        </span>
                        {{ $priority->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@stop