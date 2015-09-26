@extends('layouts.default')
@section('title', 'New Task')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default form-wrapper">
                <div class="panel-heading">Schedule your task</div>
                <div class="panel-body">
                    {!! Form::model($task = new \Keep\Entities\Task, ['route' => ['member::tasks.store', $user]]) !!}
                        @include('users.tasks.partials._main_form', ['taskFormSubmitButton' => 'Schedule Task'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop
