@extends('layouts.admin')

@section('title', 'Trashed Assignments')

@section('content')
    <div class="admin-contents-wrapper">
        @if ($trashedAssignments->isEmpty())
            <div class="well text-center">Currently, there is no trashed assignment.</div>
        @else
            <div class="well">
                <div class="huge text-center">{{ $trashedAssignments->total() }} trashed {{ str_plural('assignment', $trashedAssignments->total()) }}</div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Deleted At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($trashedAssignments as $assignment)
                        <tr>
                            <td>{{ $assignment->id }}</td>
                            <td>{{ $assignment->assignment_name }}</td>
                            <td>{{ $assignment->present()->formatFullTime($assignment->deleted_at) }}</td>
                            <td>
                                @include('admin.assignments.partials.restore_form')
                                @include('admin.assignments.partials.force_delete_form')
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <div class="text-center">{!! $trashedAssignments->render() !!}</div>
    </div>
@stop