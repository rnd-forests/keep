@extends('layouts.admin')

@section('title', 'Disabled Members')

@section('content')
    <div class="admin-contents-wrapper">
        @if ($disabledAccounts->isEmpty())
            <div class="well text-center">Currently, there is no disabled account.</div>
        @else
            <div class="well">
                <div class="huge text-center">{{ $disabledAccounts->count() }} disabled {{ str_plural('account', $disabledAccounts->count()) }}</div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
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
                        @foreach($disabledAccounts as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->present()->formatFullTime($user->deleted_at) }}</td>
                                <td>
                                    @include('admin.accounts.partials.restore_form')
                                    @include('admin.accounts.partials.force_delete_form')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <div class="text-center">{!! $disabledAccounts->render() !!}</div>
    </div>
@stop
