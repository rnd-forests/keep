@extends('layouts.admin')
@section('title', 'Edit - ' . $group->name)
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default form-wrapper">
                <div class="panel-heading">Create new group</div>
                <div class="panel-body">
                    {!! Form::model($group, ['method' => 'PATCH', 'route' => ['admin::groups.update', $group]]) !!}
                        @include('admin.groups.partials._main_form', ['groupFormSubmitButton' => 'Update Group'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop
