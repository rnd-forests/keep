@extends('layouts.default')
@section('title', 'Password Recovery . Keep')
@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
            <div class="form-wrapper">
                {!! Form::open() !!}
                    <div class="form-group">
                        {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
                        {!! Form::email('email', null, ['class' => 'form-control input-lg',
                            'placeholder' => 'username@example.com']) !!}
                        {!! error_text($errors, 'email') !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Send Password Reset Link', ['class' => 'btn btn-primary']) !!}
                    </div>
                {!! Form::close() !!}
                <ol class="breadcrumb">
                    <li><a href="{{ route('auth::login') }}">Sign In</a></li>
                    <li><a href="{{ route('auth::register') }}">Sign Up</a></li>
                </ol>
            </div>
		</div>
	</div>
@stop
