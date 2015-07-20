@extends('layouts.app')
@section('title', 'Groups')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="list-group">
                <a href="#" class="list-group-item active">Current Groups</a>
                @foreach($groups as $group)
                    <a href="{{ route('member::groups.show', [$authUser, $group]) }}" class="list-group-item">
                        <span class="badge">
                            {{ plural('member', counting($group->users)) }}
                        </span>
                        {{ $group->name }}
                    </a>
                @endforeach
            </div>
            {!! render_pagination($groups) !!}
        </div>
    </div>
@stop