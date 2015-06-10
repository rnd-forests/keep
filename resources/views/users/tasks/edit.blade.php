@extends('layouts.app')

@section('meta-description', str_limit($task->content, 250))

@section('title', $task->title)

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary form-wrapper">
                <div class="panel-heading"><strong>Edit - {{ $task->title }}</strong></div>
                <div class="panel-body">
                    @include('layouts.partials.errors')
                    {!! Form::model($task, ['method' => 'PATCH', 'route' => ['users.tasks.update', $user, $task]]) !!}
                        @include('users.tasks.partials.form', ['taskFormSubmitButton' => 'Update Task'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop