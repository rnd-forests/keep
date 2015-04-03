@extends('layouts.admin')

@section('title')
    {{ $user->name }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-4 admin-user-profile">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if($user->isAdmin())
                        <span class="pull-right label label-success">Admin</span>
                    @endif
                    {{ $user->name }}
                </div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="text-center">
                            @include('users.partials.avatar', ['size' => 120])
                        </div>
                    </li>
                    <li class="list-group-item">
                        <h6 class="list-group-item-heading">Date of Birth</h6>
                        {{ $user->present()->printAttribute($user->present()->formatUserTime($user->birthday)) }}
                    </li>
                    <li class="list-group-item">
                        <h6 class="list-group-item-heading">E-Mail Address</h6>
                        {{ $user->email }}
                    </li>
                    <li class="list-group-item">
                        <h6 class="list-group-item-heading">Address</h6>
                        {{ $user->address }}
                    </li>
                    <li class="list-group-item">
                        <h6 class="list-group-item-heading">Company</h6>
                        {{ $user->present()->printAttribute($user->company) }}
                    </li>
                    <li class="list-group-item">
                        <h6 class="list-group-item-heading">Personal Website</h6>
                        {{ $user->present()->printAttribute($user->website) }}
                    </li>
                    <li class="list-group-item">
                        <h6 class="list-group-item-heading">Phone Number</h6>
                        {{ $user->present()->printAttribute($user->phone) }}
                    </li>
                    <li class="list-group-item">
                        <h6 class="list-group-item-heading">About Yourself</h6>
                        {{ $user->present()->printAttribute($user->about) }}
                    </li>
                    <li class="list-group-item">
                        <h6 class="list-group-item-heading">Joined Date</h6>
                        {{ $user->present()->formatUserTime($user->created_at) }}
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-8">
            <div class="timeline timeline-center">
                <li class="tl-header">
                    <div class="btn btn-info">Now</div>
                </li>
                @foreach($tasks->chunk(2) as $taskSet)
                    <li class="tl-item">
                        <div class="tl-wrap b-success">
                            <span class="tl-date">{{ $taskSet[0]->present()->formatTaskTime($taskSet[0]->created_at) }}</span>
                            <div class="tl-content panel">
                                <span class="arrow left pull-up"></span>
                                <div class="text-lt">{{ $taskSet[0]->title }}</div>
                                <div class="panel-body pull-in">
                                    {{ $taskSet[0]->content }}
                                </div>
                            </div>
                        </div>
                    </li>
                    @if(isset($taskSet[1]))
                        <li class="tl-item tl-left">
                            <div class="tl-wrap b-primary">
                                <span class="tl-date">{{ $taskSet[1]->present()->formatTaskTime($taskSet[0]->created_at) }}</span>
                                <div class="tl-content panel">
                                    <span class="arrow right pull-up"></span>
                                    <div class="text-lt">{{ $taskSet[1]->title }}</div>
                                    <div class="panel-body pull-in">
                                        {{ $taskSet[1]->content }}
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@stop