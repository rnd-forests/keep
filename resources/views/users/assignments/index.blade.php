@extends('layouts.app')

@section('meta-description', 'All assignments (personal & group) associated with ' . Auth::user()->name)

@section('title', 'Assignments')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="list-group">
                <a href="#" class="list-group-item active">{{ $memberAssignments->count() }} Personal
                    {{ str_plural('Assignment', $memberAssignments->count()) }}</a>
                @foreach($memberAssignments as $assignment)
                    <a href="{{ route('users.personal.assignments.show', [Auth::user(), $assignment]) }}" class="list-group-item">
                        <span class="badge">{{ $assignment->present()->formatTimeForHumans($assignment->created_at) }}</span>
                        {{ $assignment->assignment_name }}
                    </a>
                @endforeach
            </div>
        </div>
        <div class="col-md-6">
            <div class="list-group">
                <a href="#" class="list-group-item active">{{ $groupAssignments->count() }} Group
                    {{ str_plural('Assignment', $groupAssignments->count()) }}</a>
                @foreach($groupAssignments as $assignment)
                    <a href="{{ route('users.group.assignments.show', [Auth::user(), $assignment]) }}" class="list-group-item">
                        <span class="badge">{{ $assignment->present()->formatTimeForHumans($assignment->created_at) }}</span>
                        {{ $assignment->assignment_name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@stop