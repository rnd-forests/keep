@extends('layouts.admin')

@section('title', $user->name)

@section('content')
    <div class="row">
        <div class="col-md-5 account-profile">
            @include('admin.accounts.partials.account_info')
        </div>
        <div class="col-md-7">
            <div class="timeline">
                <li class="tl-header"><div class="btn btn-info">Now</div></li>
                @foreach($user->tasks as $task)
                    <li class="tl-item">
                        <div class="tl-wrap b-success">
                            <span class="tl-date">{{ $task->present()->formatTime($task->created_at) }}</span>
                            <div class="tl-content panel">
                                <span class="arrow left pull-up"></span>
                                <div class="text-lt"><strong>{{ $task->title }}</strong></div>
                                <div class="panel-body pull-in">
                                    {!! $task->content !!}
                                </div>
                                <div class="panel-footer">
                                    {{ $task->present()->getRemainingDays($task->finishing_date) }}
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </div>
        </div>
    </div>
@stop