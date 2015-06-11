@extends('layouts.app')

@section('meta-description', 'All assignments (personal & group) associated with ' . Auth::user()->name)

@section('title', 'Assignments')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="list-group">
                {{--*/ $countOne = $memberAssignments->count() /*--}}
                <a href="#" class="list-group-item active">{{ $countOne }} Personal {{ str_plural('Assignment', $countOne) }}</a>
                @foreach($memberAssignments as $assignment)
                    <a href="{{ route('member::assignments.personal.show', [Auth::user(), $assignment]) }}" class="list-group-item">
                        <span class="badge">{{ $assignment->present()->formatTimeForHumans($assignment->created_at) }}</span>
                        {{ $assignment->assignment_name }}
                    </a>
                @endforeach
            </div>
        </div>
        <div class="col-md-6">
            <div class="list-group">
                {{--*/ $countTwo = $groupAssignments->count() /*--}}
                <a href="#" class="list-group-item active">{{ $countTwo }} Group {{ str_plural('Assignment', $countTwo) }}</a>
                @foreach($groupAssignments as $assignment)
                    <a href="{{ route('member::assignments.group.show', [Auth::user(), $assignment]) }}" class="list-group-item">
                        <span class="badge">{{ $assignment->present()->formatTimeForHumans($assignment->created_at) }}</span>
                        {{ $assignment->assignment_name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@stop