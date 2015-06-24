@extends('layouts.admin')
@section('title', 'Add Members - ' . $group->name)
@section('content')
    <div class="row add-users-wrapper">
        <div class="col-md-5">
            <div class="list-group">
                <div class="list-group-item active">
                    <strong>{{ $group->name }}</strong> | {{ plural2('member', 'current', counting($users)) }}
                </div>
                @foreach($users as $user)
                    <div class="list-group-item">
                        <a href="{{ route('admin::members.active.profile', $user) }}">{{ $user->name }}</a>
                        <div class="pull-right">
                            @include('admin.groups.partials._remove_users_form')
                        </div>
                        <div class="clearfix"></div>
                    </div>
                @endforeach
            </div>
            {!! render_pagination($users) !!}
        </div>
        <div class="col-md-7">
            @include('admin.groups.partials._add_users_form')
            <div class="text-center">
                <a href="{{ route('admin::groups.active') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
@stop
