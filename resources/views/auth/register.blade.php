@extends('layouts.app')

@section('meta-description', 'Keep - Register new account')

@section('title', 'Register')

@section('header')
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '491350914355734',
                xfbml      : true,
                version    : 'v2.3'
            });
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
@stop

@section('content')
	<div class="row">
        <div class="col-md-6 col-md-offset-3">
            @include('auth.partials.social_auth')
            <div class="panel panel-primary form-wrapper">
                <div class="panel-heading"><strong>Register</strong></div>
                <div class="panel-body">
                    @include('layouts.partials.errors')
                    {!! Form::open() !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
                            {!! Form::text('name', null, ['class' => 'form-control input-lg']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
                            {!! Form::email('email', null, ['class' => 'form-control input-lg', 'placeholder' => 'username@example.com']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
                            {!! Form::password('password', ['class' => 'form-control input-lg']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('password_confirmation', 'Password Confirmation', ['class' => 'control-label']) !!}
                            {!! Form::password('password_confirmation', ['class' => 'form-control input-lg']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Create Account', ['class' => 'btn btn-lg btn-primary']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="panel-footer form-link">
                    Already had an account? <a href="{{ route('login') }}"> Login here</a>
                </div>
            </div>
        </div>
    </div>
@stop
