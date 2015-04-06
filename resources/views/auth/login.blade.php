@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="row">
		<div class="col-md-6 col-md-offset-3">
            <div class="form-wrapper">
                <h2 class="form-header">Login</h2>
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
                <div class="text-center help-block form-link">
                    Forgot Your Password? <a href="{{ url('auth/password/email') }}">Reset here</a><br>
                    Don't have an account? <a href="{{ route('register_path') }}"> Create a free account</a>
                </div>
            </div>
		</div>
	</div>
@stop
