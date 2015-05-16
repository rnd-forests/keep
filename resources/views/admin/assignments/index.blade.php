@extends('layouts.admin')

@section('title', 'Assignments')

@section('content')
    <div class="assignments-wrapper">
        @if($assignments->isEmpty())
            <div class="well text-center">Currently, there is no assignment.</div>
        @else
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    @foreach($assignments as $assignment)
                        <div class="panel panel-primary">
                            <div class="panel-heading text-center"><strong>{{ $assignment->assignment_name }}</strong></div>
                            <div class="panel-body text-center">
                                <h4>{{ $assignment->task->title }}</h4>
                                <p>{{ $assignment->task->content }}</p>
                                <div class="text-center">
                                    <span class="label label-primary">
                                        {{ $assignment->present()->formatTimeForHumans($assignment->created_at) }}
                                    </span>
                                    @if($assignment->groups->isEmpty())
                                        <span class="label label-info">member assignment</span>
                                    @else
                                        <span class="label label-warning">group assignment</span>
                                    @endif
                                </div>
                            </div>
                            <div class="panel-footer">
                                <div class="text-center">
                                    <a href="{{ route('admin.assignments.show', $assignment) }}">
                                        <button class="btn btn-info btn-sm"  data-toggle="tooltip" data-placement="bottom" title="View assignment details">
                                            <i class="fa fa-arrow-right"></i>
                                        </button>
                                    </a>
                                    <a href="{{ route('admin.assignments.edit', $assignment) }}">
                                        <button class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Edit assignment">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                    </a>
                                    @include('admin.assignments.partials.delete_form')
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="text-center">{!! $assignments->render() !!}</div>
                </div>
            </div>
        @endif
    </div>
@stop