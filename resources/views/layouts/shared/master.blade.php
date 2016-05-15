<!DOCTYPE html>
<html>
<head>
	<!-- title -->
	<title>@yield('title')</title>

	<!-- stylesshets and scripts   -->
	@include('layouts.shared.assets')
	
	@yield('assets')

</head>

<body>
	@include('layouts.shared.header')

	<!-- header -->
	@yield('header')

	<!-- body -->
	@yield('body')

	<!-- footer -->
	@yield('footer')

	@include('layouts.shared.footer')


</body>
</html>