@extends('layouts.admin')
@section('title', 'Disabled Members')
@section('content')
    <div class="admin-contents-wrapper">
        @if (blank($disabledAccounts))
            <div class="well text-center">Currently, there is no disabled account.</div>
        @else
            <div class="well">
                <div class="huge text-center">{{ plural2('account', 'disabled', $disabledAccounts->total()) }}</div>
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
                                <td>{{ full_time($user->deleted_at) }}</td>
                                <td>
                                    @include('admin.accounts.partials._restore_form')
                                    @include('admin.accounts.partials._force_delete_form')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        {!! render_pagination($disabledAccounts) !!}
    </div>
@stop
