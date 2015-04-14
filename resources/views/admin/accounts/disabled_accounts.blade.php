@extends('layouts.admin')

@section('title', 'Disabled Accounts')

@section('content')
    <div class="admin-contents-wrapper">
        @if ($disabledAccounts->isEmpty())
            <div class="well text-center">Currently, there is no disabled account.</div>
        @else
            <div class="panel panel-default">
                <div class="panel-heading">Disabled Accounts Table</div>
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
                        @foreach($disabledAccounts as $user)
                            <tr>
                                <td class="text-center">{{ $user->id }}</td>
                                <td class="text-navy">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-center">{{ $user->present()->formatFullTime($user->deleted_at) }}</td>
                                <td class="text-center">
                                    @include('admin.accounts.partials.restore_form')
                                    @include('admin.accounts.partials.force_delete_form')
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        <div class="text-center">{!! $disabledAccounts->render() !!}</div>
    </div>
@stop
