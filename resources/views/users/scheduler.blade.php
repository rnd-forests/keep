@extends('layouts.app')

@section('meta-description', 'Task scheduler of ' . Auth::user()->name)

@section('title', 'Task Scheduler')

@section('content')
    <div id="user-task-scheduler"></div>
@stop