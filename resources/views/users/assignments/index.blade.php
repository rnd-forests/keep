@extends('layouts.app')
@section('meta-description', 'All assignments (personal & group) associated with ' . $authUser->name)
@section('title', 'Assignments')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="list-group">
                <a href="#" class="list-group-item active">Personal - {{ plural('Assignment', counting($memberAssignments)) }}</a>
                @foreach($memberAssignments as $assignment)
                    <a href="{{ route('member::assignments.personal.show', [$authUser, $assignment]) }}" class="list-group-item">
                        <span class="badge">{{ humans_time($assignment->created_at) }}</span>
                        {{ $assignment->assignment_name }}
                    </a>
                @endforeach
            </div>
        </div>
        <div class="col-md-6">
            <div class="list-group">
                <a href="#" class="list-group-item active">Group - {{ plural('Assignment', counting($groupAssignments)) }}</a>
                @foreach($groupAssignments as $assignment)
                    <a href="{{ route('member::assignments.group.show', [$authUser, $assignment]) }}" class="list-group-item">
                        <span class="badge">{{ humans_time($assignment->created_at) }}</span>
                        {{ $assignment->assignment_name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@stop