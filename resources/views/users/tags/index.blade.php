@extends('layouts.app')

@section('meta-description', 'All tags associated with tasks of ' . Auth::user()->name)

@section('title', 'Tags')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="list-group">
                <a class="list-group-item active"><i class="fa fa-tags"></i> Task Tags</a>
                @foreach($tags->load('tasks') as $tag)
                    <a class="list-group-item" href="{{ route('users.tag.tasks', [Auth::user(), $tag]) }}">
                        <span class="badge">
                            {{--*/ $counter = $tag->tasks->where('user_id', Auth::user()->id)->count() /*--}}
                            {{ $counter }} {{ str_plural('task', $counter) }}
                        </span>
                        {{ $tag->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@stop