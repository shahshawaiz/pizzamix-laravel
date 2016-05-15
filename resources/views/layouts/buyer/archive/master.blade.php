<!Doctype html>

<html>

	<head>

		<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}"/>
		<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/screen.css') }}"/>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="{{ URL::asset('http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css') }}">
		<!-- jQuery library -->
		<script src="{{ URL::asset('https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js') }}"></script>
		<!-- Latest compiled JavaScript -->
		<script src="{{ URL::asset('http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js') }}"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- title -->
		<title>@yield('title')</title>

		<!-- css/js -->
		@yield('head')


	</head>

	<body>
		
		<!-- static header  -->
		@include('layouts.buyer.header')

		<!-- static sidebar -->
		@include('layouts.buyer.sidebar')				

		<!-- dynamic header -->
		@yield('header')

		<!-- dynamic body -->
		@yield('body')

		<!-- dynmaic footer -->
		@yield('footer')

		<!-- static footer -->
		@include('layouts.buyer.footer')

	</body>

</html>