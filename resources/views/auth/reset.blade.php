@extends('layouts.app')
@section('meta-description', 'Keep - Reset account password')
@section('title', 'Password Reset')
@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary form-wrapper">
                <div class="panel-heading"><strong>Reset your password</strong></div>
                <div class="panel-body">
                    @include('layouts.partials._form_errors')
                    {!! Form::open() !!}
                        {!! Form::hidden('token', $token) !!}
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
                            {!! Form::submit('Reset Password', ['class' => 'btn btn-lg btn-primary']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
		</div>
	</div>
@stop
