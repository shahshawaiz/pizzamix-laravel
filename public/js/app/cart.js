
function confirmed(){
	$('#delete').trigger('change');
}

//-------------------------------------------------- document ready modal	

$(document).ready(function(){

	$.ajaxSetup({ 
	 	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
	 	cache : false 
	 });

	//token for csrf protection
	var token = $('meta[name="csrf-token"]').attr('content');
	var order_id, entity_type, product_id, item_id, item_type, cart_count;

	//-------------------------------------------------- event listners modal


   $(document).on('click', '#delete', function(){
      	
      	//tag record with clicked element for further processing
        $(this).addClass('clicked_element');

   });

   $(document).on('change', '#delete', function(){
      	
      	var order;
      	var decrement_cart = 0;

   		var clicked_element = $('.cart-left').find('.clicked_element');

	 	entity_type=$(clicked_element).data("type");
	 	product_id=$(clicked_element).data("product-id");
	 	item_id=$(clicked_element).data("item-id");	 	 	
	 	item_type=$(clicked_element).data("item-type"); 

	 	if(entity_type == 5)
	 		decrement_cart = 1;

	 	// populate order_id with session's order_id
	 	order = getSession(decrement_cart);

	 	// remove item
	 	destroy(entity_type, order.order_id, product_id, item_id, item_type);

      	//remove tag. so that it can be reused 
        $(clicked_element).removeClass('clicked_element');

   });   


	//-------------------------------------------------- function definitions


	function destroy(entity_type, order_id, product_id, item_id, item_type){
		
		var post_url, redirect_url;

		// 1 = cuisine, 2=category, 3=product, 4=item
		switch(entity_type){
			case 5:
				post_url = APP_URL + '/order/product';
				data = { _token :token, _method: 'delete', order_id: order_id, product_id: product_id };
				break;

			case 6:
				post_url = APP_URL + '/order/item';
				data = { _token :token, _method: 'delete', order_id: order_id, product_id: product_id, item_id: item_id, item_type: item_type};				
				break;

			default:
				return 0;																
		}

		redirect_url = APP_URL + '/cart';
		
		//ajax delete request
		$.ajax({
			method: 'POST',
	        url: post_url,										
			data: data,	      				
	        beforeSend: function (xhr) {
	            if (token) {
	                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
	            }
	        },				
			success:function(data){
                console.log('delete success. says cart.js.');
            },error:function(){ 
                console.log('delete failed.  says cart.js.');
            }
		})
		.done(function(data){
			console.log(data);
			window.location.href = redirect_url
		});	
	    	
	}

	function getSession(decrement_cart){

		var order;
		//ajax get request
		$.ajax({
			method: 'GET',
	        url: APP_URL + '/order/session',
			data: { _token :token, decrement_cart: decrement_cart },	      					        
			async: false,	    	        	
			success:function(data){
                console.log('get session success. says cart.js.');
            },error:function(){ 
                console.log('get session failed.  says cart.js.');
            }
		})
		.done(function(data){
			order = data;
		});	
	    	
	    return order;
	}


});
