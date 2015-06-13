@extends('layouts.admin')
@section('title', 'Trashed Assignments')
@section('content')
    <div class="admin-contents-wrapper">
        @if (blank($trashedAssignments))
            <div class="well text-center">Currently, there is no trashed assignment.</div>
        @else
            <div class="well">
                <div class="huge text-center">{{ plural2('assignment', 'trashed', $trashedAssignments->total()) }}</div>
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
                            <td>{{ full_time($assignment->deleted_at) }}</td>
                            <td>
                                @include('admin.assignments.partials._restore_form')
                                @include('admin.assignments.partials._force_delete_form')
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        {!! render_pagination($trashedAssignments) !!}
    </div>
@stop