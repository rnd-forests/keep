@extends('layouts.admin')

@section('title')
    {{ $assignment->assignment_name }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="assignment-wrapper">
                <h2 class="assignment-name text-center">{{ $assignment->assignment_name }}</h2>

                <div class="page-header"><h5>Associated Task</h5></div>
                @include('users.tasks.partials.task', ['task' => $assignment->task])

                @if($assignment->users->isEmpty())
                    <div class="page-header">
                        <h5>{{ $assignment->groups->count() }} Assigned {{ str_plural('Group', $assignment->groups->count()) }}</h5>
                    </div>
                    <ul class="assignment-assignables">
                        @foreach($assignment->groups as $group)
                            <li><a href="{{ route('admin.groups.show', $group) }}">{{ $group->name }}</a></li>
                        @endforeach
                    </ul>
                @else
                    <div class="page-header">
                        <h5>{{ $assignment->users->count() }} Assigned {{ str_plural('Member', $assignment->users->count()) }}</h5>
                    </div>
                    <ul class="assignment-assignables">
                        @foreach($assignment->users as $member)
                            <li><a href="{{ route('admin.active.account.profile', $member) }}">{{ $member->name }}</a></li>
                        @endforeach
                    </ul>
                @endif

                <div class="page-header"><h5>Assignment Controls</h5></div>
                <div class="assignment-controls text-center">
                    <a href="{{ route('admin.assignments.edit', $assignment) }}">
                        <button class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Edit assignment">
                            <i class="fa fa-pencil"></i>
                        </button>
                    </a>
                    @include('admin.assignments.partials.delete_form')
                </div>
            </div>
        </div>
    </div>
@stop