@extends('layouts.admin')

@section('title', 'Trashed Groups')

@section('content')
    <div class="admin-contents-wrapper">
        @if ($trashedGroups->isEmpty())
            <div class="well text-center">Currently, there is no trashed group.</div>
        @else
            <div class="well">
                <div class="huge text-center">{{ $trashedGroups->total() }} trashed {{ str_plural('group', $trashedGroups->total()) }}</div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Members</th>
                        <th>Deleted at</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($trashedGroups as $group)
                            <tr>
                                <td>{{ $group->id }}</td>
                                <td>{{ $group->name }}</td>
                                <td>{{ $group->users->count() }}</td>
                                <td>{{ $group->present()->formatFullTime($group->deleted_at) }}</td>
                                <td>
                                    @include('admin.groups.partials.restore_form')
                                    @include('admin.groups.partials.force_delete_form')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <div class="text-center">{!! $trashedGroups->render() !!}</div>
    </div>
@stop
