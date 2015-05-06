@extends('layouts.app')

@section('title', 'Homepage')

@section('banner')
    <div class="home-cover" xmlns="http://www.w3.org/1999/html">
        {!! Html::image('img/home-cover.jpg', $alt = 'Keep home cover photo') !!}
    </div>
@stop

@section('content')
    <div class="row">
        <div class="home-contents">
            <div class="text-center">
                @if(Auth::check())
                    <a href="{{ route('users.tasks.create', Auth::user()) }}">
                        <button class="btn btn-primary btn-lg">Schedule New Task</button>
                    </a>
                    <br/>
                    <a href="{{ route('users.show', Auth::user()) }}">
                        <button class="btn btn-info btn-lg">View Your Current Profile</button>
                    </a>
                    <br/>
                    <a href="{{ route('users.dashboard', Auth::user()) }}">
                        <button class="btn btn-danger btn-lg">Browsing Your Tasks &amp; Assignments</button>
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
