@extends('layouts.admin')
@section('title', 'Disabled Members')
@section('content')
    <div class="admin-contents-wrapper">
        @if (blank($disabledMembers))
            <div class="text-center text-warning">No disabled account available.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Disabled at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($disabledMembers->chunk(10) as $memberStack)
                            @foreach($memberStack as $member)
                                <tr>
                                    <td>{{ $member->id }}</td>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->email }}</td>
                                    <td>{{ full_time($member->deleted_at) }}</td>
                                    <td>
                                        @include('admin.members.partials._restore_form')
                                        @include('admin.members.partials._force_delete_form')
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        {!! render_pagination($disabledMembers) !!}
    </div>
@stop
