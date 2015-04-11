@extends('layouts.admin')

@section('title', 'Trashed Groups')

@section('content')
    <div class="admin-contents-wrapper">
        @if ($trashedGroups->isEmpty())
            <div class="well text-center">Currently, there is no trashed group.</div>
        @else
            <div class="panel panel-default">
                <div class="panel-heading">Trashed Groups Table</div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
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
                                <td class="text-center">{{ $group->id }}</td>
                                <td class="text-navy">{{ $group->name }}</td>
                                <td class="text-center">{{ $group->users->count() }}</td>
                                <td class="text-center">{{ $group->present()->formatFullTime($group->deleted_at) }}</td>
                                <td class="text-center">
                                    @include('admin.groups.partials.restore_form')
                                    @include('admin.groups.partials.force_delete_form')
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        <div class="text-center">{!! $trashedGroups->render() !!}</div>
    </div>
@stop
