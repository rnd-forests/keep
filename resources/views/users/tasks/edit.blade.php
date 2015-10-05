@extends('layouts.default')
@section('title', $task->title)
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default form-wrapper">
                <div class="panel-heading">Schedule your task</div>
                <div class="panel-body">
                    {!! Form::model($task, ['method' => 'PATCH', 'route' => ['user.tasks.update', $user, $task]]) !!}
                        @include('users.tasks.partials._main_form', ['taskFormSubmitButton' => 'Update Task'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop
