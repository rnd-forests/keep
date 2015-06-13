@extends('layouts.app')
@section('title', $task->title)
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary form-wrapper">
                <div class="panel-heading"><strong>Edit - {{ $task->title }}</strong></div>
                <div class="panel-body">
                    @include('layouts.partials._form_errors')
                    {!! Form::model($task, ['method' => 'PATCH', 'route' => ['member::tasks.update', $user, $task]]) !!}
                        @include('users.tasks.partials._main_form', ['taskFormSubmitButton' => 'Update Task'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop