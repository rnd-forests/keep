@extends('layouts.admin')

@section('title', 'Active Members')

@section('content')
    <div class="admin-contents-wrapper">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-area-chart"></i> Current number of active accounts</div>
                    <div class="panel-body">
                        <div class="huge text-center">{{ $usersCount }} {{ str_plural('account', $usersCount) }}</div>
                    </div>
                </div>
            </div>
        </div>
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
                    @foreach($activeAccounts as $account)
                        <tr>
                            <td class="text-center">{{ $account->id }}</td>
                            <td class="text-navy">{{ $account->name }}</td>
                            <td>{{ $account->email }}</td>
                            <td class="text-center">{{ $account->tasks->count() }}</td>
                            <td class="text-center">{{ $account->present()->formatTime($account->created_at) }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.active.account.profile', $account->slug) }}" class="btn btn-primary btn-circle"
                                   data-toggle="tooltip" data-placement="bottom" title="View Profile">
                                    <i class="fa fa-user"></i>
                                </a>
                                <a href="#" class="btn btn-info btn-circle"
                                   data-toggle="tooltip" data-placement="bottom" title="Send notification">
                                    <i class="fa fa-bell-o"></i>
                                </a>
                                @unless($account->roles->contains('name', 'admin'))
                                    @include('admin.accounts.partials.delete_form')
                                @endunless
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center">{!! $activeAccounts->render() !!}</div>
    </div>
@stop
