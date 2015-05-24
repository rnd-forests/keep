@extends('layouts.admin')

@section('title', 'Active Members')

@section('content')
    <div class="admin-contents-wrapper">
        <div class="well">
            <div class="huge text-center">{{ $usersCount }} active {{ str_plural('account', $usersCount) }}</div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>{!! sort_accounts_by('id', 'ID') !!}</th>
                        <th>{!! sort_accounts_by('name', 'Name') !!}</th>
                        <th>{!! sort_accounts_by('email', 'Email') !!}</th>
                        <th>Tasks</th>
                        <th>Groups</th>
                        <th>Assignments</th>
                        <th>{!! sort_accounts_by('created_at', 'Joined Date') !!}</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($activeAccounts as $account)
                        <tr>
                            <td>{{ $account->id }}</td>
                            <td>{{ $account->name }}</td>
                            <td>{{ $account->email }}</td>
                            <td>{{ $account->tasks->count() }}</td>
                            <td>{{ $account->groups->count() }}</td>
                            <td>{{ $account->assignments->count() }}</td>
                            <td>{{ $account->present()->formatTime($account->created_at) }}</td>
                            <td>
                                <a href="{{ route('admin.active.account.profile', $account) }}" class="btn btn-primary btn-circle"
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
