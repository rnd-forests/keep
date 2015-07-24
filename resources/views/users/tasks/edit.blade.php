@extends('layouts.app')
@section('title', $task->title)
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="form-wrapper">
                {!! Form::model($task, ['method' => 'PATCH', 'route' => ['member::tasks.update', $user, $task]]) !!}
                    @include('users.tasks.partials._main_form', ['taskFormSubmitButton' => 'Update Task'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
