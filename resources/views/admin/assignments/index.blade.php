@extends('layouts.admin')

@section('title', 'Assignments')

@section('content')
    <div class="assignments-wrapper">
        @if($assignments->isEmpty())
            <div class="well text-center">Currently, there is no assignment.</div>
        @else
            <div class="col-md-6 col-md-offset-3">
                @foreach($assignments as $assignment)
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <div class="assignment-name">{{ $assignment->assignment_name }}</div>
                            <div class="text-center">
                                <span class="label label-primary">
                                    {{ $assignment->present()->formatTimeForHumans($assignment->created_at) }}
                                </span>
                                @if($assignment->groups->isEmpty())
                                    <span class="label label-info">Member</span>
                                @else
                                    <span class="label label-info">Group</span>
                                @endif
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="text-center">
                                <a href="{{ route('admin.assignments.show', $assignment->slug) }}">
                                    <button class="btn btn-info btn-circle"  data-toggle="tooltip" data-placement="bottom" title="View assignment details">
                                        <i class="fa fa-arrow-right"></i>
                                    </button>
                                </a>
                                <a href="{{ route('admin.assignments.edit', $assignment->slug) }}">
                                    <button class="btn btn-primary btn-circle" data-toggle="tooltip" data-placement="bottom" title="Edit assignment">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                </a>
                                @include('admin.assignments.partials.delete_form', $assignment)
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="text-center">{!! $assignments->render() !!}</div>
            </div>
        @endif
    </div>
@stop