@extends('layouts.app')

@section('title')
    Password Recovery
@stop

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="form-wrapper">
                <h2 class="form-header">Forgot your password?</h2>
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                @include('layouts.partials.errors')
                {!! Form::open() !!}
                    <div class="form-group">
                        {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
                        {!! Form::email('email', null, ['class' => 'form-control input-lg', 'placeholder' => 'username@example.com']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Send Password Reset Link', ['class' => 'btn btn-lg btn-success']) !!}
                    </div>
                {!! Form::close() !!}
                <div class="text-center help-block form-link">
                    Trying to <a href="{{ route('login_path') }}"> Login</a><br>
                    Don't have an account? <a href="{{ route('register_path') }}"> Create a free account</a>
                </div>
			</div>
		</div>
	</div>
@stop
