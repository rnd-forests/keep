@extends('layouts.default')
@section('title', 'Sign In . Keep')
@section('content')
    <div class="row">
		<div class="col-md-6 col-md-offset-3">
            <div class="form-wrapper">
                @include('auth.partials._social_auth')
                @if(session('login_error'))
                    <div class="alert alert-danger text-center">
                        {!! session('login_error') !!}
                    </div>
                @endif
                {!! Form::open() !!}
                    <div class="form-group">
                        {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
                        {!! Form::email('email', null, ['class' => 'form-control input-lg']) !!}
                        {!! error_text($errors, 'email') !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
                        {!! Form::password('password', ['class' => 'form-control input-lg']) !!}
                        {!! error_text($errors, 'password') !!}
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label><input type="checkbox" name="remember"> Remember me</label>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Sign In', ['class' => 'btn btn-primary']) !!}
                    </div>
                {!! Form::close() !!}
                <ol class="breadcrumb">
                    <li><a class="social-auth" data-toggle="modal" data-target="#social-auth">Social Authentication</a></li>
                    <li><a href="{{ url('auth/password/email') }}">Reset your Password</a></li>
                    <li><a href="{{ route('auth::register') }}">Sign Up</a></li>
                </ol>
            </div>
		</div>
	</div>
@stop
