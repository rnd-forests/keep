@extends('layouts.app')

@section('title', 'Tags')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="list-group">
                @foreach($tags->load('tasks') as $tag)
                    <a class="list-group-item" href="{{ route('users.tag.tasks', [Auth::user(), $tag]) }}">
                        <span class="badge">
                            {{ $tag->tasks->where('user_id', Auth::user()->id)->count() }}
                            {{ str_plural('task', $tag->tasks->where('user_id', Auth::user()->id)->count()) }}
                        </span>
                        {{ $tag->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@stop