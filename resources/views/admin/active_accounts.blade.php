@extends('layouts.admin')

@section('title')
    Active Accounts
@stop

@section('content')
    <div class="admin-contents-wrapper">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading"><i class="fa fa-area-chart"></i> Current number of active accounts</div>
                    <div class="panel-body">
                        <div class="huge text-center">{{ $userCount }} active accounts</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Active Accounts Table</div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Tasks</th>
                            <th>Joined Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="text-center">{{ $user->id }}</td>
                                <td class="text-navy">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-center">{{ $user->tasks()->count() }}</td>
                                <td class="text-center">{{ $user->present()->formatUserTime($user->created_at) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.active.account.profile', $user->slug) }}" class="btn btn-primary btn-circle"
                                       data-toggle="tooltip" data-placement="bottom" title="View Profile">
                                        <i class="fa fa-user"></i>
                                    </a>
                                    <a href="#" class="btn btn-info btn-circle"
                                       data-toggle="tooltip" data-placement="bottom" title="Send notification">
                                        <i class="fa fa-bell-o"></i>
                                    </a>
                                    @unless($user->isAdmin())
                                        @include('admin.accounts.delete_form')
                                    @endunless
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <footer class="panel-footer">
                <div class="pull-right">{!! $users->render() !!}</div>
                <div class="clearfix"></div>
            </footer>
        </div>
    </div>
@stop
