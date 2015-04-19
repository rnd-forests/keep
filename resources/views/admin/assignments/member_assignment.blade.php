@extends('layouts.admin')

@section('title', 'Member Assignment')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="form-wrapper">
                <h2 class="form-header">Create Member Assignment</h2>
                @include('layouts.partials.errors')
                @include('admin.assignments.partials.member_assignment_form', ['taskFormSubmitButton' => 'Assign Task'])
            </div>
        </div>
    </div>
@stop