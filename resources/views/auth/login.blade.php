@extends('layouts.app')

@section('meta-description', 'Keep - Login')

@section('title', 'Login')

@section('content')
    <div class="row">
		<div class="col-md-6 col-md-offset-3">
            <p class="text-center">
                <a href="{{ route('github.authentication') }}" class="btn btn-default"
                   data-toggle="tooltip" data-placement="bottom" title="Login with GitHub">
                    <i class="fa fa-github"></i>
                </a>
            </p>
            <div class="panel panel-primary form-wrapper">
                <div class="panel-heading"><strong>Login</strong></div>
                <div class="panel-body">
                    @include('layouts.partials.errors')
                    {!! Form::open() !!}
                        <div class="form-group">
                            {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
                            {!! Form::email('email', null, ['class' => 'form-control input-lg']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
                            {!! Form::password('password', ['class' => 'form-control input-lg']) !!}
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label><input type="checkbox" name="remember"> Remember Me</label>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Login', ['class' => 'btn btn-lg btn-primary']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="panel-footer form-link">
                    Forgot Your Password? <a href="{{ url('auth/password/email') }}">Reset here</a><br>
                    Don't have an account? <a href="{{ route('register') }}"> Create a free account</a>
                </div>
            </div>
		</div>
	</div>
@stop
