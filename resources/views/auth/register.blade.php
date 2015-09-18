@extends('layouts.app')
@section('meta-description', 'Keep - Register new account')
@section('title', 'Registration')
@section('content')
	<div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="form-wrapper">
                @include('auth.partials._social_auth')
                {!! Form::open() !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
                        {!! Form::text('name', null, ['class' => 'form-control input-lg']) !!}
                        {!! error_text($errors, 'name') !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
                        {!! Form::email('email', null, ['class' => 'form-control input-lg',
                            'placeholder' => 'username@example.com']) !!}
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
                        {!! Form::submit('Create Account', ['class' => 'btn btn-primary']) !!}
                    </div>
                {!! Form::close() !!}
                <div class="form-link">
                    Already had an account? <a href="{{ route('auth::login') }}"> Login here</a>
                </div>
            </div>
        </div>
    </div>
@stop
