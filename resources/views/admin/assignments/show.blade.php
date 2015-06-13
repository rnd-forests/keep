@extends('layouts.admin')
@section('title', $assignment->assignment_name)
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="assignment-wrapper">
                <h2 class="text-center">{{ $assignment->assignment_name }}</h2>
                @include('users.tasks.partials._task', ['task' => $assignment->task])
                @if(blank($assignment->users))
                    <div class="page-header">
                        <h5>{{ plural2('Group', 'Assigned', counting($assignment->groups)) }}</h5>
                    </div>
                    <ul class="assignment-assignables">
                        @foreach($assignment->groups as $group)
                            <li><a href="{{ route('admin::groups.active.show', $group) }}">{{ $group->name }}</a></li>
                        @endforeach
                    </ul>
                @else
                    <div class="page-header">
                        <h5>{{ plural2('Member', 'Assigned', counting($assignment->users)) }}</h5>
                    </div>
                    <ul class="assignment-assignables">
                        @foreach($assignment->users as $member)
                            <li><a href="{{ route('admin::members.active.profile', $member) }}">{{ $member->name }}</a></li>
                        @endforeach
                    </ul>
                @endif
                <div class="assignment-controls text-center">
                    <a href="{{ route('admin::assignments.published.edit', $assignment) }}">
                        <button class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Edit assignment">
                            <i class="fa fa-pencil"></i>
                        </button>
                    </a>
                    @include('admin.assignments.partials._delete_form')
                </div>
            </div>
        </div>
    </div>
@stop