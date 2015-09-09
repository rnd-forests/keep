@extends('layouts.app')
@section('title', 'New Task')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="form-wrapper">
                {!! Form::model($task = new \Keep\Entities\Task, ['route' => ['member::tasks.store', $user]]) !!}
                    @include('users.tasks.partials._main_form', ['taskFormSubmitButton' => 'Schedule Task'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
