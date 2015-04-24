@extends('layouts.admin')

@section('title', 'Member Assignment')

@section('assignable-objects')
    <div class="form-group">
        <div class="form-group">
            {!! Form::label('user_list', 'Choose Members', ['class' => 'control-label']) !!}
            {!! Form::select('user_list[]', $users, null, ['id' => 'user_list', 'class' => 'form-control', 'multiple']) !!}
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="form-wrapper">
                <h2 class="form-header">Create Member Assignment</h2>
                @include('layouts.partials.errors')
                {!! Form::model([$task = new \Keep\Task, $assignment = new \Keep\Assignment], ['route' => ['store.member.assignment']]) !!}
                    @include('admin.assignments.partials.form', ['assignmentButton' => 'Create Assignment'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop