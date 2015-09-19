@extends('layouts.default')
@section('title', 'Tags')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="list-group">
                <a class="list-group-item active">
                    <i class="fa fa-tags"></i> Task Tags
                </a>
                @foreach($tags as $tag)
                    <a class="list-group-item"
                       href="{{ route('member::tags.task', [$authUser, $tag]) }}">
                        {{ $tag->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@stop