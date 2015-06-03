<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title')</title>
    <meta name="description" content="@yield('meta-description', 'A simple tasks management application.')">
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<link href="{{ elixir('css/all.css') }}" rel="stylesheet">

	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
    @yield('header')
    @include('layouts.partials.nav')
    @yield('banner')
    <div class="container">
        @include('flash::message')
        @yield('content')
    </div>
    @include('layouts.partials.footer')
    {!! Html::script('js/libraries.js') !!}
    {!! Html::script('js/app.js') !!}
    @yield('footer')
</body>
</html>
