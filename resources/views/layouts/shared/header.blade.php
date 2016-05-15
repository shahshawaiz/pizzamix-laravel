
<header>
	<div class="submenu-header">
		<div class="home-header-subpart">
			<div class="header-info1">
				<a href="{{ route('home') }}"><img src="{{ URL::asset('images/logo.png') }}" alt=""></a>
				<p>
					<img src="{{ URL::asset('images/phone.png') }}" alt="">
					<span>22 666 999</span>
				</p>
				<div class="cb"></div>
			</div>
			<div class="header-info2">
				<ul style="float: right">
					
					@if(Auth::check() == false) 
						<li><a href="{{ route('home' ) }}">Home</a></li>
						<li><a href="{{ route('home' )}}">menu</a></li>
						<li><a href="{{ route('about' ) }}">About</a></li>
						<li><a href="{{ route('contact' ) }}">Contact</a></li>						
						<li><a href="{{ route('login' ) }}">Login</a></li>
						<li>
							<a href="{{ route('cart' ) }}">
     			         	   @if( session('cart_count') != 0)
	   	   				         	<div class="noti_bubble">{{ session('cart_count') }}</div>
     			         	   @endif								
								<img src="{{ URL::asset('images/cart.png') }}" alt="">
							</a>
						</li>

					@else
						<li><a href="{{ route('home' ) }}">Home</a></li>											

		         	   @if(Auth::user()['accountType'] == '1')
   				         	<li>									
     			         	   @if( count( $checkouts->where('status', 0) ) )
	   	   				         	<div class="noti_bubble">{{ count($checkouts->where('status', 0) ) }}</div>
     			         	   @endif
	   				         	<a href="{{ route('admin/dashboard' ) }}">{{Auth::user()->username}}</a>
   				         	</li>


		         	   @elseif(Auth::user()['accountType'] == '2')
		         	   		<li>									
     			         	   @if( count(Auth::user()->Checkout ) )
	   	   				         	<div class="noti_bubble">{{  count(Auth::user()->Checkout ) }}</div>
     			         	   @endif
   				         		<a href="{{ route('buyer/dashboard' ) }}">{{Auth::user()->username}}</a>
   				         	</li>

		         	   @elseif(Auth::user()['accountType'] == '3')
			         	   <li>									
     			         	   @if( count( $checkouts->where('status', 2) ) )
	   	   				         	<div class="noti_bubble">{{ count( $checkouts->where('status', 2) ) }}</div>
     			         	   @endif
   				         		<a href="{{ route('kitchen/dashboard' ) }}">{{Auth::user()->username}}</a>
   				         	</li>

		         	   @endif

   					   <li><a href="{{ route('getLogout' ) }}">Logout</a></li>		
		         	   <!-- only show cart to buyer -->
		         	   @if(Auth::user()['accountType'] == '2')
							<li>
     			         	   @if( session('cart_count') != 0)
	   	   				         	<div class="noti_bubble">{{ session('cart_count') }}</div>
     			         	   @endif							
								<a href="{{ route('cart' ) }}">
									<img src="{{ URL::asset('images/cart.png') }}" alt="">
								</a>
							</li>										

		         	   @endif

					@endif	

				</ul>

				<div class="cb"></div>
			</div>
			<div class="cb"></div>
		</div>
	</div>

</header>
