@extends('layouts.app')

@section('title')
    Edit - {{ $task->title }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="form-wrapper">
                <h2 class="form-header">Edit - {{ $task->title }}</h2>
                @include('layouts.partials.errors')
                {!! Form::model($task, ['method' => 'PATCH', 'route' => ['users.tasks.update', $user->slug, $task->slug]]) !!}
                    @include('tasks.partials.form', ['taskFormSubmitButton' => 'Update Task'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop