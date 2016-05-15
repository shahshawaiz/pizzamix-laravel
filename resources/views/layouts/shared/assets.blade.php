
<!-- stylesheets -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('update_2/css/style.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('update_2/css/screen.css') }}"/>

<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/screen.css') }}"/>

<!-- jquery -->
<script src="{{ URL::asset('js/lib/jquery/jquery.min.js') }}"></script>

<!-- bootstrap CSS -->
<link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">

<!-- bootstrap JS -->
<script src="{{ URL::asset('js/lib/bootstrap/bootstrap.min.js') }}"></script>

 <!-- google fonts -->
<link href="{{ URL::asset('fonts/google-fonts.css') }}" rel="stylesheet" type="text/css">

<!-- responsive content view -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- csrf protection token -->
<meta name="csrf-token" content="{{ csrf_token() }}" />		


<!-- global variables -->
<script type="text/javascript">
	var APP_URL = {!! json_encode(url('/')) !!};

	$(document).ready(function(){

	    $('[data-toggle="tooltip"]').tooltip(); 

	});
		
</script>