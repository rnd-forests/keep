@extends('layouts.app')

@section('title', 'New Task')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="form-wrapper">
                <h2 class="form-header">Create task</h2>
                @include('layouts.partials.errors')
                {!! Form::model($task = new \Keep\Task, ['route' => ['users.tasks.store', $user->slug]]) !!}
                    @include('tasks.partials.form', ['taskFormSubmitButton' => 'Create Task'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop