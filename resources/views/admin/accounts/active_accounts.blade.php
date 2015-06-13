@extends('layouts.admin')
@section('title', 'Active Members')
@section('content')
    <div class="admin-contents-wrapper">
        <div class="well">
            <div class="huge text-center">{{ plural2('account', 'active', $activeAccounts->total()) }}</div>
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
                            <td>{{ counting($account->tasks) }}</td>
                            <td>{{ counting($account->groups) }}</td>
                            <td>{{ counting($account->assignments) }}</td>
                            <td>{{ short_time($account->created_at) }}</td>
                            <td>
                                <a href="{{ route('admin::members.active.profile', $account) }}" class="btn btn-primary btn-circle"
                                   data-toggle="tooltip" data-placement="bottom" title="View Profile">
                                    <i class="fa fa-user"></i>
                                </a>
                                <a href="#" class="btn btn-info btn-circle"
                                   data-toggle="tooltip" data-placement="bottom" title="Send notification">
                                    <i class="fa fa-bell-o"></i>
                                </a>
                                @unless($account->hasRole('admin'))
                                    @include('admin.accounts.partials._delete_form')
                                @endunless
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {!! render_pagination($activeAccounts) !!}
    </div>
@stop
