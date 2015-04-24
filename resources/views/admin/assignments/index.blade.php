@extends('layouts.admin')

@section('title', 'Assignments')

@section('content')
    @foreach($assignments as $assignment)
        <li><a href="{{ route('admin.assignments.show', $assignment->slug) }}">{{ $assignment->assignment_name }}</a></li>
    @endforeach
@stop