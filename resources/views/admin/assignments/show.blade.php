@extends('layouts.admin')

@section('title')
    {{ $assignment->assignment_name }}
@stop

@section('content')
    @include('admin.assignments.partials.delete_form', $assignment)
    {{ var_dump($assignment) }}
@stop