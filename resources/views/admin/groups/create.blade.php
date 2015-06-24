@extends('layouts.admin')
@section('title', 'Create New Group')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary form-wrapper">
                <div class="panel-heading"><strong>Create New Group</strong></div>
                <div class="panel-body">
                    {!! Form::model($group = new \Keep\Entities\Group, ['route' => 'admin::groups.active.store']) !!}
                        @include('admin.groups.partials._main_form', ['groupFormSubmitButton' => 'Create Group'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop
