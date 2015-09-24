@extends('layouts.default')
@section('title', 'Sign Up . Keep')
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
                                {!! Form::password('password', ['class' => 'form-control input-lg']) !!}
                                {!! error_text($errors, 'password') !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('password_confirmation', 'Password Confirmation', ['class' => 'control-label']) !!}
                                {!! Form::password('password_confirmation', ['class' => 'form-control input-lg']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Create an Account', ['class' => 'btn btn-primary']) !!}
                    </div>
                {!! Form::close() !!}
                <ol class="breadcrumb">
                    <li><a class="social-auth" data-toggle="modal" data-target="#social-auth">Social Authentication</a></li>
                    <li><a href="{{ route('auth::login') }}">Sign In</a></li>
                </ol>
            </div>
        </div>
    </div>
@stop
