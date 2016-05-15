@extends('layouts.shared.master')

@section('title')
	Pizzamix
@endsection

@section('assets')

@endsection
    
@section('header')

@endsection

@section('body')
	
	<div class="cart">
	
		<div class="cart-left">

			<div class="cart-header">My Cart</div>

			@if($total_price == 0)
				<div class="empty-cart">
					<h1>You've got an empty cart. </h1>
				</div>
			@endif

            @foreach($order_detail_items as $key=>$value)
	            <div class="cart-content">
	              <div class="cart-info" style="width: 100%">
	                <div class="cart-info-part1" >              
	                                
 	                  <div class="list-image">
 	                  	<img  src="{{asset('images/uploads/product/').'/'.$value['product_thumbnail'] }}"> 
	                  </div>                             
	                  <br>		  
	                  	<h1>{{ $value['product_name'] }} ({{ $value['quantity']}} x {{ $value['product_price'] }} )</h1>
	                  <br>
		              <h2>  
		                <span>Subtotal:</span>Kr {{ $value['sub_total'] }}-/
		              </h2>

	                </div>
	                
	                <div class="cart-info-part2">
	                  <a href="#" id="delete" data-toggle="modal" data-target="#confirmDelete" data-type="5" data-product-id="{{ $value['product_id'] }}" data-toggle="tooltip" title="Delete"><span class="glyphicon glyphicon-trash" ></span></a>
	                </div>
	                <div class="cb"></div>
	              </div>
	              <div class="cb"></div>
	            </div>

                @if( array_key_exists('accessory', $value) != null )

                   @foreach($value['accessory'] as $item=>$item_value)

       			   <div class="cart-content">
       			   		<span><b>{{ $item_value['type'] }}</b> | {{ $item_value['item_name'] }} | Kr {{ $item_value['item_price'] }}-/</span>
		                <div class="cart-info-part2">
		                  <a href="#" id="delete" data-toggle="modal" data-target="#confirmDelete" data-type="6" data-product-id="{{ $value['product_id'] }}" data-item-type="{{ $item_value['item_type'] }}" data-item-id="{{ $item_value['item_id'] }}" data-toggle="tooltip" title="Delete"><span class="glyphicon glyphicon-trash" ></span></a>
		                </div>
       			   </div>
                   @endforeach        			   

                @endif 

                @if( array_key_exists('ingredient', $value) != null )

                   @foreach($value['ingredient'] as $item=>$item_value)

       			   <div class="cart-content">
       			   		<span><b>{{ $item_value['type'] }}</b> | {{ $item_value['item_name'] }} | Kr {{ $item_value['item_price'] }}-/</span>

		                <div class="cart-info-part2">
		                  <a href="#" id="delete" data-toggle="modal" data-target="#confirmDelete" data-type="6" data-product-id="{{ $value['product_id'] }}" data-item-type="{{ $item_value['item_type'] }}" data-item-id="{{ $item_value['item_id'] }}" data-toggle="tooltip" title="Delete"><span class="glyphicon glyphicon-trash" ></span></a>
		                </div>
       			   </div>
                   @endforeach        			   

                @endif 

                @if( array_key_exists('sidedish', $value) != null )

                   @foreach($value['sidedish'] as $item=>$item_value)

       			   <div class="cart-content">
       			   		<span><b>{{ $item_value['type'] }}</b> | {{ $item_value['item_name'] }} | Kr {{ $item_value['item_price'] }}-/</span>
		                <div class="cart-info-part2">
		                  <a href="#" id="delete" data-toggle="modal" data-target="#confirmDelete" data-type="6" data-product-id="{{ $value['product_id'] }}" data-item-type="{{ $item_value['item_type'] }}" data-item-id="{{ $item_value['item_id'] }}" data-toggle="tooltip" title="Delete"><span class="glyphicon glyphicon-trash" ></span></a>
		                </div>
       			   </div>
                   @endforeach        			   

                @endif


                @if( array_key_exists('default', $value) != null )

                   @foreach($value['default'] as $item=>$item_value)

       			   <div class="cart-content">
       			   		<span><b>{{ $item_value['type'] }}</b> | {{ $item_value['item_name'] }}</span>
		                <div class="cart-info-part2">
		                  <a href="#" id="delete" data-toggle="modal" data-target="#confirmDelete" data-type="6" data-product-id="{{ $value['product_id'] }}" data-item-type="{{ $item_value['item_type'] }}" data-item-id="{{ $item_value['item_id'] }}" data-toggle="tooltip" title="Delete"><span class="glyphicon glyphicon-trash" ></span></a>
		                </div>
       			   </div>
                   @endforeach        			   

                @endif

            @endforeach
			<div class="total-price">
				<h1>TOTAL PRIS:</h1>
				<p>Kr {{ $total_price }} -/</p>
			</div>

			<br></br>

			<div class="checkout-button-2">
				<div class="checkout-btn"><a href="{{ route('checkout') }}"><span><img src="images/checkout.png" alt="">PROCEED TO CHECKOUT</span></a></div>
				<div class="shop-btn"><a href="{{ route('home') }}"><span><img src="images/continue-shop.png" alt="">CONTINUE SHOPPING</span></a></div>
				<div class="cb"></div>
			</div>

		</div>
		
		<div class="cart-right">
			
			@foreach($categories as $category)

				<a href="{{ route('category.show', $category->id ) }}">
					<div class="available-item">

						<div class="available-item-info">
							<img src="images/available-menu1.png" alt="">
							<span>{{ $category->name }}</span>
						</div>	

					</div>							
				</a>

			@endforeach	
		</div>
	
		<div class="cb"></div>
		
	</div>

	@include('pages.admin.partials.confirm_modal')

	<script src="{{ URL::asset('js/app/confirm_modal.js') }}"></script>
	<script src="{{ URL::asset('js/app/cart.js') }}"></script>

@endsection

@section('footer')
	
@endsection