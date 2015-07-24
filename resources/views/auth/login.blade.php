@extends('layouts.app')
@section('meta-description', 'Keep - Login')
@section('title', 'Login')
@section('content')
    <div class="row">
		<div class="col-md-6 col-md-offset-3">
            @include('auth.partials._social_auth')
            <div class="form-wrapper">
                @if(session()->has('login_error'))
                    <div class="alert alert-danger text-center">{!! session()->get('login_error') !!}</div>
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
                            <label><input type="checkbox" name="remember"> Remember Me</label>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Login', ['class' => 'btn btn-primary']) !!}
                    </div>
                {!! Form::close() !!}
                <div class="form-link">
                    Forgot Your Password? <a href="{{ url('auth/password/email') }}">Reset here</a><br>
                    Don't have an account? <a href="{{ route('auth::register') }}"> Create a free account</a>
                </div>
            </div>
		</div>
	</div>
@stop
