@extends('layouts.app')

@section('title')
    {{ $task->title }}
@stop

@section('content')
    {{ var_dump($task) }}
@stop
