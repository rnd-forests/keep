@extends('layouts.admin')

@section('title')
    {{ $user->name }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-4 account-profile">
            @include('admin.accounts.basic_information')
        </div>
        <div class="col-md-8">
            <div class="timeline timeline-center">
                <li class="tl-header">
                    <div class="btn btn-info">Now</div>
                </li>
                @foreach($tasks->chunk(2) as $taskSet)
                    <li class="tl-item">
                        <div class="tl-wrap b-success">
                            <span class="tl-date">
                                {{ $taskSet[0]->present()->formatTaskTime($taskSet[0]->created_at) }}
                                @if($taskSet[0]->isCompleted())
                                    <button class="btn btn-info btn-circle"><i class="fa fa-check"></i></button>
                                @else
                                    <button class="btn btn-danger btn-circle"><i class="fa fa-times"></i></button>
                                @endif
                            </span>
                            <div class="tl-content panel">
                                <span class="arrow left pull-up"></span>
                                <div class="text-lt">
                                    {{ $taskSet[0]->title }}
                                </div>
                                <div class="panel-body pull-in">
                                    {{ $taskSet[0]->content }}
                                </div>
                            </div>
                        </div>
                    </li>
                    @if(isset($taskSet[1]))
                        <li class="tl-item tl-left">
                            <div class="tl-wrap b-primary">
                                <span class="tl-date">
                                    {{ $taskSet[1]->present()->formatTaskTime($taskSet[0]->created_at) }}
                                    @if($taskSet[1]->isCompleted())
                                        <button class="btn btn-info btn-circle"><i class="fa fa-check"></i></button>
                                    @else
                                        <button class="btn btn-danger btn-circle"><i class="fa fa-times"></i></button>
                                    @endif
                                </span>
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