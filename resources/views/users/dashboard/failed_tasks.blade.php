@extends('layouts.app')

@section('meta-description', 'The collection of all failed tasks associated with ' . Auth::user()->name)

@section('title', 'Failed Tasks')

@section('task-type', 'Failed Tasks')

@section('content')
    @include('users.dashboard.partials.collection')
@stop