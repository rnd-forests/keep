@extends('layouts.app')

@section('title', 'Register')

@section('content')
	<div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="form-wrapper">
                <h2 class="form-header">Register</h2>
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
                <div class="text-center help-block form-link">
                    Already had an account? <a href="{{ route('login') }}"> Login here</a>
                </div>
            </div>
        </div>
    </div>
@stop
