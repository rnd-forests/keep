@extends('layouts.admin')

@section('title')
    Disabled Accounts
@stop

@section('content')
    <div class="admin-contents-wrapper">
        <div class="panel panel-default">
            <div class="panel-heading">Disabled Accounts Table</div>
            @if ($disabledAccounts->isEmpty())
                <div class="panel-body">
                    <div class="text-center">Currently, there is no disabled account.</div>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Deleted at</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($disabledAccounts as $user)
                            <tr>
                                <td class="text-center">{{ $user->id }}</td>
                                <td class="text-navy">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-center">{{ $user->present()->formatUserTimeFull($user->deleted_at) }}</td>
                                <td class="text-center">
                                    @include('admin.accounts.restore_form')
                                    @include('admin.accounts.force_delete_form')
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <footer class="panel-footer">
                    <div class="pull-right">{!! $disabledAccounts->render() !!}</div>
                    <div class="clearfix"></div>
                </footer>
            @endif
        </div>
    </div>
@stop
