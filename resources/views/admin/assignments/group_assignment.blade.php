@extends('layouts.admin')

@section('title', 'Group Assignment')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="form-wrapper">
                <h2 class="form-header">Create Group Assignment</h2>
                @include('layouts.partials.errors')
                @include('admin.assignments.partials.group_assignment_form', ['taskFormSubmitButton' => 'Assign Task'])
            </div>
        </div>
    </div>
@stop