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
                @unless(auth()->check())
                    <div class="well">
                        <a href="{{ route('auth::register') }}">
                            <button class="btn btn-danger btn-lg">Sign up for a free account</button>
                        </a>
                        <a href="{{ route('auth::login') }}">
                            <button class="btn btn-primary btn-lg">Log in with your account</button>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop
