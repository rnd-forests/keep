@extends('layouts.admin')

@section('title')
    {{ $user->name }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-5 account-profile">
            @include('admin.accounts.partials.basic_information')
        </div>
        <div class="col-md-7">
            <div class="timeline">
                <li class="tl-header"><div class="btn btn-info">Now</div></li>
                @foreach($user->tasks as $task)
                    <li class="tl-item">
                        <div class="tl-wrap b-success">
                            <div class="tl-content panel">
                                <span class="arrow left pull-up"></span>
                                <div class="text-lt">{{ $task->title }}</div>
                                <div class="panel-body pull-in">
                                    {!! $task->content !!}
                                </div>
                                <div class="panel-footer">
                                    {{ $task->present()->formatTime($task->starting_date) }} to
                                    {{ $task->present()->formatTime($task->finishing_date) }}
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </div>
        </div>
    </div>
@stop