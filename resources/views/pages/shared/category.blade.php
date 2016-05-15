@extends('layouts.shared.master')

@section('title')
	{{$cagtegory_name}} - Pizzamix
@endsection

@section('assets')
	<!-- <link href='https://fonts.googleapis.com/css?family=Roboto:700,500' rel='stylesheet' type='text/css'> -->

	<meta name="csrf-token" content="{{ csrf_token() }}" />	

@endsection
    
@section('header')

	<div class="submenu-banner">
		<h1>{{$cagtegory_name}}</h1>
	</div>

@endsection

@section('body')

	<div class="submenu">

			@foreach($products as $product)

				<a href="{{ route('product.show', $product->id) }}">
					<div class="deals-part">
						<img src="{{ URL::asset('images/submenu-image1.jpg') }}" alt="">
						<div class="deal-subpart-category">
							<div class="deal-content-category">
								<h1>{{$product->name}}</h1>
								<p>{{$product->description}}</p>
							</div>
							<div class="cb"></div>
							<div class="deal-content-info">
								<div class="sub-menu-info">
									
									@if(isset($product->Product_Size->get(0)->price) !=null)
										<span>Kr {{$product->Product_Size->get(0)->price}}-/</span>
									@else
										<span>N/A</span>										
									@endif

									<img src="{{ URL::asset('images/deal-cart.png') }}" alt="">
								</div>
								<div class="cb"></div>
							</div>
						</div>
					</div>	
				</a>		
				
				
			@endforeach


			

			<div class="cb"></div>
	
	</div>
	

	<div class="featured-menu">
		<h1>You may also like to order</h1>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
		<div class="home-menu">

            @foreach ($cuisines as $cuisine)
                <div class="menu-content">
                    <div class="menu-1">
                        <div class="menu-1-info">
                            <img src="{{ URL::asset('images/menu1.png' )}}" alt="">
                            <span>{{ $cuisine->name }}</span>
                        </div>
                        
                    </div>

                    <div class="menu-part1">
                        
                        <ul>
                            @foreach($cuisine->Category as $item)
                                <a href="{{ route('category.show', $item->id ) }}"><li>{{$item->name}}</li></a>
                            @endforeach
                        </ul>


                    </div>
                    <img src="{{ URL::asset('images/menu-image1.jpg') }}" alt="">
                </div>

            @endforeach

			<div class="cb"></div>
		</div>
			
@endsection

@section('footer')

    @include('layouts.shared.subscribe')    

@endsection