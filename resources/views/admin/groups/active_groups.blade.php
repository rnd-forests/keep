@extends('layouts.admin')

@section('title', 'Active Groups')

@section('content')
    <div class="groups-wrapper">
        @if($groups->isEmpty())
            <div class="well text-center">Currently, there is no active group.</div>
        @else
            @foreach($groups->chunk(3) as $groupStack)
                <div class="row">
                    @foreach($groupStack as $group)
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">{{ $group->name }}</div>
                                <div class="text-center">
                                    <span class="label label-primary">
                                        {{ $group->users->count() }} {{ str_plural('member', $group->users->count()) }}
                                    </span>
                                </div>
                                <div class="panel-body">
                                    <div class="well">{{ $group->description }}</div>
                                    <div class="text-center">
                                        <h5>
                                            Created at: {{ $group->present()->formatFullTime($group->created_at) }}<br/>
                                            {{ $group->present()->formatTimeForHumans($group->created_at) }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <span class="btn btn-default btn-circle"
                                          data-toggle="tooltip" data-placement="bottom" title="Group ID">
                                        {{ $group->id }}
                                    </span>
                                    <a href="{{ route('admin.groups.show', $group->slug) }}" class="btn btn-info btn-circle"
                                       data-toggle="tooltip" data-placement="bottom" title="View group details">
                                        <i class="fa fa-arrow-right"></i>
                                    </a>
                                    <a href="{{ route('admin.groups.edit', $group->slug) }}" class="btn btn-primary btn-circle"
                                       data-toggle="tooltip" data-placement="bottom" title="Edit group information">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="{{ route('admin.groups.add.users', $group->slug) }}" class="btn btn-violet btn-circle"
                                       data-toggle="tooltip" data-placement="bottom" title="Add more users">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                    <a href="#" class="btn btn-warning btn-circle"
                                       data-toggle="tooltip" data-placement="bottom" title="Send notification">
                                        <i class="fa fa-bell-o"></i>
                                    </a>
                                    @include('admin.groups.partials.delete_form')
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
            <div class="text-center">{!! $groups->render() !!}</div>
        @endif
    </div>
@stop
