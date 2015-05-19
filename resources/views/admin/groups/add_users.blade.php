@extends('layouts.admin')

@section('title', 'Add Members - ' . $group->name)

@section('content')
    <div class="row add-users-wrapper">
        <div class="col-md-5">
            <div class="list-group">
                <div class="list-group-item active">
                    <strong>{{ $group->name }}</strong> | {{ $users->count() }} current {{ str_plural('member', $users->count()) }}
                </div>
                @foreach($users as $user)
                    <div class="list-group-item">
                        <a href="{{ route('admin.active.account.profile', $user) }}">{{ $user->name }}</a>
                        <div class="pull-right">
                            @include('admin.groups.partials.remove_form')
                        </div>
                        <div class="clearfix"></div>
                    </div>
                @endforeach
            </div>
            <div class="text-center">{!! $users->render() !!}</div>
        </div>
        <div class="col-md-7">
            @include('layouts.partials.errors')
            @include('admin.groups.partials.add_users_form')
        </div>
    </div>
@stop