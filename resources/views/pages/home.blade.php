@extends('layouts.app')

@section('title', 'Homepage')

@section('banner')
    <div class="home-cover">
        {!! Html::image('img/home-cover.png', $alt = 'Keep home cover photo') !!}
    </div>
@stop

@section('content')
    <div class="row">
        <div class="home-contents">
            <div class="text-center">
                @if(Auth::check())
                    <a href="{{ route('users.tasks.index', Auth::user()) }}">
                        <button class="btn btn-danger btn-lg">Browsing Your Tasks</button>
                    </a>
                    <a href="{{ route('users.tasks.create', Auth::user()) }}">
                        <button class="btn btn-primary btn-lg">Schedule New Task</button>
                    </a>
                @else
                    <a href="{{ route('register') }}">
                        <button class="btn btn-danger btn-lg">Register</button>
                    </a>
                    <a href="{{ route('login') }}">
                        <button class="btn btn-primary btn-lg">Login</button>
                    </a>
                @endif
            </div>
        </div>
    </div>
@stop
