<header>
	<div class="home-header">
		<div class="home-header-subpart">
			<div class="header-info1">
				<a href="{{ URL::asset('/home' )}}"><img src="{{ URL::asset('images/logo.png') }}" alt=""></a>
				<p>
					<img src="images/phone.png" alt="">
					<span>22 666 999</span>
				</p>
				<div class="cb"></div>
			</div>
			<div class="header-info2">
				<ul>
					<li><a href="{{ URL::asset('/home' )}}">Home</a></li>
					<li><a href="{{  action("SecurityController@getLogin") }}">Sign In</a></li>
					<li><a href="{{  action("SecurityController@getLogin") }}">Register</a></li>
					<li><a href="#"><img src="images/cart.png" alt=""></a></li>
				</ul>
				<div class="cb"></div>
			</div>
			<div class="cb"></div>
		</div>
		
		<div class="home-header-detail">
			<h1>THE TASTE YOU</h1>
			<h2>LOVE THE MOST</h2>
			<div class="header-detail-part">
				<p class="menu-btn"><a href="#">view menu</a></p>
				<p class="location-btn"><a href="#">view location</a></p>
				<div class="cb"></div>
			</div>
		</div>
	</div>
</header>