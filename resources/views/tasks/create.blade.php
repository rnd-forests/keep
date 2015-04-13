@extends('layouts.app')

@section('title', 'New Task')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Create a new task</div>
                <div class="panel-body">
                    <div class="form-wrapper">
                        @include('layouts.partials.errors')
                        {!! Form::model($task = new \Keep\Task, ['route' => ['users.tasks.store', $user->slug]]) !!}
                            @include('tasks.partials.form', ['taskFormSubmitButton' => 'Create Task'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop