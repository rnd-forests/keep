@extends('layouts.app')

@section('title', 'Tags')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <ul class="list-group">
                @foreach($tags->load('tasks') as $tag)
                    <li class="list-group-item">
                        <span class="badge">
                            {{ $tag->tasks->where('user_id', Auth::user()->id)->count() }}
                            {{ str_plural('task', $tag->tasks->where('user_id', Auth::user()->id)->count()) }}
                        </span>
                        {{ $tag->name }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@stop