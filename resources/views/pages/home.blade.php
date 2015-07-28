@extends('layouts.app')
@section('title', 'Homepage')
@section('content')
    <div class="row">
        <div class="home-contents">
            <div class="home-buttons col-md-6 col-md-offset-3">
                @unless(auth()->check())
                    <a href="{{ route('auth::register') }}">
                        <button class="btn btn-danger btn-lg">Sign up for a free account</button>
                    </a>
                    <a href="{{ route('auth::login') }}">
                        <button class="btn btn-primary btn-lg">Log in with your account</button>
                    </a>
                @else
                    <a href="{{ route('member::dashboard', $authUser) }}">
                        <button class="btn btn-success btn-lg">Visit your dashboard</button>
                    </a>
                @endif
            </div>
        </div>
    </div>
@stop
