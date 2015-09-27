@extends('layouts.admin')
@section('title', 'Active Groups')
@section('content')
    <div class="groups-wrapper">
        @if(blank($groups))
            <div class="well text-center">No active group available.</div>
        @else
            @foreach($groups->chunk(10) as $groupStack)
                @foreach($groupStack as $group)
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="panel panel-default">
                                <div class="panel-heading text-center">
                                    <h4>{{ $group->name }}</h4>
                                    <h6>{{ humans_time($group->created_at) }}</h6>
                                </div>
                                <div class="panel-body">
                                    <div class="text-center">
                                        <span class="label label-primary">
                                            {{ plural('member', counting($group->users)) }}
                                        </span>
                                    </div>
                                    <p class="group-description text-info">{{ $group->description }}</p>
                                </div>
                                <div class="panel-footer text-center">
                                    <a href="{{ route('admin::groups.show', $group) }}"
                                       class="btn btn-info btn-xs"
                                       data-toggle="tooltip"
                                       data-placement="bottom"
                                       title="View group details">
                                        <i class="fa fa-arrow-right"></i>
                                    </a>
                                    <a href="{{ route('admin::groups.edit', $group) }}"
                                       class="btn btn-primary btn-xs"
                                       data-toggle="tooltip"
                                       data-placement="bottom"
                                       title="Edit group information">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="{{ route('admin::groups.add', $group) }}"
                                       class="btn btn-default btn-xs"
                                       data-toggle="tooltip"
                                       data-placement="bottom"
                                       title="Add more users">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                    @include('admin.groups.partials._delete_form')
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
            {!! render_pagination($groups) !!}
        @endif
    </div>
@stop
