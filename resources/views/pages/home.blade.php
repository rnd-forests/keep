@extends('layouts.app')
@section('title', 'Homepage')
@section('banner')
    <div class="home-cover">
        {!! Html::image('img/home-cover.jpg', $alt = 'Keep home cover photo') !!}
    </div>
@stop
@section('content')
    <div class="row">
        <div class="home-contents">
            <div class="text-center">
                @if(auth()->check())
                    <div class="well">
                        <div class="btn-group" role="group">
                            <a href="{{ route('member::tasks.create', $authUser) }}">
                                <button class="btn btn-primary btn-lg">Schedule Task</button>
                            </a>
                            <a href="{{ route('member::dashboard', $authUser) }}">
                                <button class="btn btn-danger btn-lg">Dashboard</button>
                            </a>
                        </div>
                    </div>
                @else
                    <div class="well">
                        <a href="{{ route('auth::register') }}">
                            <button class="btn btn-danger btn-lg">Register for a Free Account</button>
                        </a>
                        <a href="{{ route('auth::login') }}">
                            <button class="btn btn-primary btn-lg">Login with Your Account</button>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop
