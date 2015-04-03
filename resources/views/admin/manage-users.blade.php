@extends('layouts.admin')

@section('title')
    Manage Accounts
@stop

@section('content')
    <div class="admin-contents-wrapper">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-area-chart"></i></div>
                    <div class="panel-body">
                        <div class="huge text-center">{{ $userCount }} active accounts</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Accounts Table</div>
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
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->tasks()->count() }}</td>
                                <td>{{ $user->present()->formatUserTime($user->created_at) }}</td>
                                <td>
                                    <a href="{{ route('admin.accounts.profile', $user->slug) }}" class="btn btn-primary btn-circle">
                                        <i class="fa fa-user"></i>
                                    </a>
                                    <a class="btn btn-info btn-circle">
                                        <i class="fa fa-bell-o"></i>
                                    </a>
                                    @unless($user->isAdmin())
                                        @include('admin.users.delete_form')
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
