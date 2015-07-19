@extends('layouts.admin')
@section('title', 'Active Groups')
@section('content')
    <div class="groups-wrapper">
        @if(blank($groups))
            <div class="well text-center">Currently, there is no active group.</div>
        @else
            @foreach($groups as $group)
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading text-center"><strong>{{ $group->name }}</strong></div>
                            <div class="panel-body">
                                <div class="text-center">
                                    <span class="label label-primary">
                                        {{ plural('member', counting($group->users)) }}
                                    </span>
                                </div>
                                <div class="well">{{ $group->description }}</div>
                                <div class="text-center"><h5>{{ humans_time($group->created_at) }}</h5></div>
                            </div>
                            <div class="panel-footer text-center">
                                <a href="{{ route('admin::groups.active.show', $group) }}" class="btn btn-info btn-circle"
                                   data-toggle="tooltip" data-placement="bottom" title="View group details">
                                    <i class="fa fa-arrow-right"></i>
                                </a>
                                <a href="{{ route('admin::groups.active.edit', $group) }}" class="btn btn-primary btn-circle"
                                   data-toggle="tooltip" data-placement="bottom" title="Edit group information">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="{{ route('admin::groups.active.add.users', $group) }}" class="btn btn-default btn-circle"
                                   data-toggle="tooltip" data-placement="bottom" title="Add more users">
                                    <i class="fa fa-plus"></i>
                                </a>
                                @include('admin.groups.partials._delete_form')
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {!! render_pagination($groups) !!}
        @endif
    </div>
@stop
