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
                    <div class="well">
                        <div class="btn-group" role="group">
                            <a href="{{ route('users.tasks.create', Auth::user()) }}">
                                <button class="btn btn-primary btn-lg">Schedule Task</button>
                            </a>
                            <a href="{{ route('users.dashboard', Auth::user()) }}">
                                <button class="btn btn-danger btn-lg">Dashboard</button>
                            </a>
                            <a href="{{ route('users.show', Auth::user()) }}">
                                <button class="btn btn-info btn-lg">Personal Profile</button>
                            </a>
                            <a href="{{ route('users.assignments.index', Auth::user()) }}">
                                <button class="btn btn-warning btn-lg">Assignments</button>
                            </a>
                            <a href="{{ route('users.groups.index', Auth::user()) }}">
                                <button class="btn btn-success btn-lg">Groups</button>
                            </a>
                        </div>
                    </div>
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
