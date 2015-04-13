@extends('layouts.app')

@section('title')
    {{ $task->title }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Edit - {{ $task->title }}</div>
                <div class="panel-body">
                    <div class="form-wrapper">
                        @include('layouts.partials.errors')
                        {!! Form::model($task, ['method' => 'PATCH', 'route' => ['users.tasks.update', $user->slug, $task->slug]]) !!}
                            @include('tasks.partials.form', ['taskFormSubmitButton' => 'Update Task'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop