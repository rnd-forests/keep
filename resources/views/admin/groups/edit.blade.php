@extends('layouts.admin')

@section('title')
    {{ $group->name }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Edit User Group</div>
                <div class="panel-body">
                    @include('layouts.partials.errors')
                    {!! Form::model($group, ['method' => 'PATCH', 'route' => ['admin.groups.update', $group]]) !!}
                        @include('admin.groups.partials.form', ['groupFormSubmitButton' => 'Update Group'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop