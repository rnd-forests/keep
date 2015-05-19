@extends('layouts.admin')

@section('title', 'Edit - ' . $group->name)

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary form-wrapper">
                <div class="panel-heading"><strong>Edit User Group</strong></div>
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