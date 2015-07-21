@extends('layouts.app')
@section('meta-description', 'Keep - Reset account password')
@section('title', 'Password Reset')
@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary form-wrapper">
                <div class="panel-heading"><strong>Reset Password</strong></div>
                <div class="panel-body">
                    {!! Form::open() !!}
                        {!! Form::hidden('token', $token) !!}
                        <div class="form-group">
                            {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
                            {!! Form::email('email', null, ['class' => 'form-control input-lg', 'placeholder' => 'username@example.com']) !!}
                            {!! error_text($errors, 'email') !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
                            {!! Form::password('password', ['class' => 'form-control input-lg']) !!}
                            {!! error_text($errors, 'password') !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('password_confirmation', 'Password Confirmation', ['class' => 'control-label']) !!}
                            {!! Form::password('password_confirmation', ['class' => 'form-control input-lg']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Reset Password', ['class' => 'btn btn-lg btn-primary']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
		</div>
	</div>
@stop
