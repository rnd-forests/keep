@extends('layouts.admin')

@section('title', 'Create New Group')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary form-wrapper">
                <div class="panel-heading"><strong>Create New Group</strong></div>
                <div class="panel-body">
                    @include('layouts.partials.errors')
                    {!! Form::model($group = new \Keep\Group, ['route' => 'admin.groups.store']) !!}
                        @include('admin.groups.partials.form', ['groupFormSubmitButton' => 'Create Group'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop