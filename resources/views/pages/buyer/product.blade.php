@extends('layouts.shared.master')

@section('title')
	{{$product->name}} - Pizzamix
@endsection

@section('assets')

@endsection
    
@section('header')

	<div class="submenu-banner">
		<h1>{{ $product->Category->name }}</h1>
	</div>

@endsection

@section('body')

	{!! Form::open(['id' => 'formOrder']) !!}

		<div class="item-detail">
			<div class="item-detail-info">

     		   <div class="product-detail-image" >
	               <img src="{{asset('images/uploads/product/').'/'.$product->thumbnail}}">                 
     		   </div>
				
				<div class="item-part">
					<h1>{{ $product->name }}</h1>
					<p>{{ $product->description }}</p>

					<div id="div_product_size">

						@foreach($product_size as $item)

							@if( $item->product_size == 1 )
								<span>								
									{{ Form::radio('available_sizes[]', $item->id, 1 , [ 'id' => $item->id] ) }}Regular
								</span>

							@elseif( $item->product_size == 2 )
								<span>
									{{ Form::radio('available_sizes[]', $item->id, null , [ 'id' => $item->id] ) }}Medium
								</span>

							@elseif( $item->product_size == 3 )
								<span>
									{{ Form::radio('available_sizes[]', $item->id, null , [ 'id' => $item->id] ) }}Large
								</span>

							@endif
							
						@endforeach	
						
					</div>												

					<div style="padding-top: 20px">

						<div style="padding-top: 20px">
							<h2 class="item-quantity">Quantity:</h2>
							{{ Form::number('quantity', 1, [ 'id'=>'quantity', 'min'=>1]) }}
						</div>				
						
						<div class="item-content">
							<div class="cb"></div>

							<div class="cb"></div>
							<h3>PRICE:</h3>
							<h3 class="price"><span id="div_product_price">
								
								@if(isset($product_size->get(0)->price) !=null)
									<span>Kr {{$product_size->get(0)->price}}-/</span>
								@else
									<span>N/A</span>
								@endif
							
							</span></h3>
							<div class="cb"></div>
						</div>

					</div>

					<!-- trigger processing of order on following div -->

					@if(isset($product_size->get(0)->price) !=null)
						<div id="btnAddToCart" class="cart-btn-2"><a href="#"><span>
							<img src="{{ URL::asset('images/cart-button.png') }}" alt="">ADD TO CART</span></a>
						</div>
					@else
						<div id="btnNotAvailable" class="cart-btn-2"><a href="#"><span>
							<img src="{{ URL::asset('images/cart-button.png') }}" alt="">Not Available</span></a>
						</div>						
					@endif


				</div>
			</div>
		</div>	

		<div class="select-item-ingredients">
			<img src="{{ URL::asset('images/divider.png') }}" alt="">
			<div class="item-ingredients-part">
				<h1>CUSTOTMIZE YOUR ORDER</h1>
				<div class="ingredients-subpart">
					<div class="ingredients-info header-info">
						<div class="ingredients-subpart-content">
							<p class="ingredients-subpart-content-heading">Accessories</p>
						</div>
					</div>

					@if( count($accessories) > 0 )

						@foreach($accessories as $accessory)

							<div class="ingredients-info">
								<div id="div_accessories" class="ingredients-subpart-content">
									{{ Form::checkbox('accessories[]', 0, null, [ 'id'=> $accessory->id , 'class'=> 'checkbox1'] ) }}
									{{$accessory->name}}		
									<div class="select-quantity1">
										<span>{{$accessory->price}},-</span>
										<div class="cb"></div>
									</div>
									<div class="cb"></div>
								</div>
							</div>

						@endforeach
					@else 

						<div class="ingredients-info">
							<div class="ingredients-subpart-content">
								<p> No listed accessories </p>
								<div class="cb"></div>
							</div>
						</div>
					@endif


				</div>
				
				
				<div class="ingredients-subpart">
					<div class="ingredients-info header-info">
						<div class="ingredients-subpart-content">
							<p class="ingredients-subpart-content-heading">INGREDIENTS</p>
						</div>
					</div>

					@if(count($ingredients) > 0)
						@foreach($ingredients as $ingredient)

						<div class="ingredients-info">
							<div id="div_ingredients" class="ingredients-subpart-content">
								{{ Form::checkbox('ingredients[]', 0, null, [ 'id'=> $ingredient->id , 'class'=> 'checkbox1'] ) }}
								{{$ingredient->name}}		
								<div class="select-quantity1">
									<span>{{$ingredient->price}},-</span>
									<div class="cb"></div>
								</div>
								<div class="cb"></div>
							</div>
						</div>

						@endforeach

					@else 

						<div class="ingredients-info">
							<div class="ingredients-subpart-content">		
								<p> No listed ingredients </p>
								<div class="cb"></div>
							</div>
						</div>
					@endif					

				</div>

				<div class="ingredients-subpart">
					<div class="ingredients-info header-info">
						<div class="ingredients-subpart-content">
							<p class="ingredients-subpart-content-heading">ADDITIONAL OPTIONS</p>
						</div>
					</div>

					@if( count($custom_orders) > 0)
						@foreach($custom_orders as $custom_order)

						<div class="ingredients-info">
							<div id="div_customOrders" class="ingredients-subpart-content">
								{{ Form::checkbox('customOptions[]', 0, null, [ 'id'=> $custom_order->id , 'class'=> 'checkbox1'] ) }}		
								{{$custom_order->name}}		
								<div class="select-quantity1">
									<span>{{$custom_order->price}},-</span>
									<div class="cb"></div>
								</div>
								<div class="cb"></div>
							</div>
						</div>

						@endforeach
					@else 

						<div class="ingredients-info">
							<div class="ingredients-subpart-content">
								<p> No listed side dishes </p>
								<div class="cb"></div>
							</div>
						</div>
					@endif


				</div>

				<div class="ingredients-subpart">
					<div class="ingredients-info header-info">
						<div class="ingredients-subpart-content">
							<p class="ingredients-subpart-content-heading">Default Serving - 

				            <small id="btn-show" style="cursor: pointer;display: none">Show</small>
				            <small id="btn-hide" style="cursor: pointer;">Hide</small>

							</p>

						</div>
					</div>

					<div class="div-default">
						@if( count($defaults) > 0)
							@foreach($defaults as $default)

							<div class="ingredients-info">
								<div id="div_defaults" class="ingredients-subpart-content">
									{{ Form::checkbox('defaults[]', 0, 1, [ 'id'=> $default->id , 'class'=> 'checkbox1'] ) }}	
									{{$default->name}}	
									<div class="cb"></div>
								</div>
							</div>

							@endforeach
						@else 

							<div class="ingredients-info">
								<div class="ingredients-subpart-content">
									<p> No listed side dishes </p>
									<div class="cb"></div>
								</div>
							</div>
						@endif
					</div>


				</div>
								
			
				<div class="cb"></div>
			</div>
			
			

			
			<div class="cb"></div>
			
			<div class="checkout-button">
				<div class="shop-btn"><a href="{{ route('home') }}"><span><img src="{{ URL::asset('images/continue-shop.png') }}" alt="">CONTINUE SHOPPING</span></a></div>
				<div class="checkout-btn"><a href="{{ route('checkout') }}"><span><img src="{{ URL::asset('images/checkout.png') }}" alt="">CHECKOUT</span></a></div>
			</div>
		</div>

	{!! Form::close() !!}

	<!-- Latest compiled JavaScript -->
	<script type="text/javascript">
		var CATEGORY_ID = {!! json_encode($product->Category->id) !!};
	</script>
	
	<script src="{{ URL::asset('js/app/product_listing.js') }}"></script>

@endsection

@section('footer')
    
    @include('layouts.shared.subscribe')    

@endsection