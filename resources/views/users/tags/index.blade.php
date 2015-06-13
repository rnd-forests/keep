@extends('layouts.app')
@section('title', 'Tags')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="list-group">
                <a class="list-group-item active"><i class="fa fa-tags"></i> Task Tags</a>
                @foreach($tags->load('tasks') as $tag)
                    <a class="list-group-item" href="{{ route('member::tags.task', [$authUser, $tag]) }}">
                        <span class="badge">
                            {{ plural('task', counting($tag->tasks->where('user_id', $authUser->id))) }}
                        </span>
                        {{ $tag->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@stop