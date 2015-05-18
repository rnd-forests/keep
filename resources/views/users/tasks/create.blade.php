@extends('layouts.app')

@section('title', 'Schedule New Task')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary form-wrapper">
                <div class="panel-heading"><strong>Schedule New Task</strong></div>
                <div class="panel-body">
                    @include('layouts.partials.errors')
                    {!! Form::model($task = new \Keep\Task, ['route' => ['users.tasks.store', $user]]) !!}
                        @include('users.tasks.partials.form', ['taskFormSubmitButton' => 'Create Task'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop