
$(document).ready(function(){

	$.ajaxSetup({ 
	 	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
	 	cache : false 
	 });

	//token for csrf protection
	var token = $('meta[name="csrf-token"]').attr('content');

	//variable for saving product_size_id
	var product_size;
	$('#div_product_size input:checked').each(function() {
	    product_size = $(this).val();
	});	

	//-------------------------------------------------- Event Listners

	//ajax call for getting price
	$('#div_product_size input').on('click', getPrice );			 
	
	//ajax all for posting order
	$('#btnAddToCart').on('click', postOrder );

   $(document).on('click', '#btn-show', function(){
        $(".div-default").show(1000);
        $("#btn-show").hide(1000);
        $("#btn-hide").show(1000);

   });   	

   $(document).on('click', '#btn-hide', function(){     
        $(".div-default").hide(1000);
        $("#btn-show").show(1000);
        $("#btn-hide").hide(1000);
   });   	


	//-------------------------------------------------- function definitions

	function getPrice(){

		$('#div_product_size input:checked').each(function() {
		    product_size = $(this).val();
		});	
		
		$.ajax({
			method: 'POST',
			cache: false,
			url: APP_URL + '/ajax/getPrice',
	        beforeSend: function (xhr) {
	            if (token) {
	                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
	            }
	        },										
			data: { _token: token, product_size_id: product_size},						
			datatype: 'JSON',
			success:function(data){
                console.log('get price success. says product_listing.js.');
            },error:function(){ 
                console.log('get price failed. says product_listing.js.');
            }
		})
		.done(function(data){
			//console.log(data);
			$('#div_product_price').text(data);
		});	

	}

	function postOrder(){

		//redirect to
		//var redirect_url = APP_URL + '/category/' + CATEGORY_ID;
		var redirect_url = APP_URL + '/cart';

		//initilaize array for ingredients
		var ingredients = [];
		var accessories = [];
		var customOptions = [];	
		var defaults = [];			

		//get quantity
		var quantity = $('#quantity').val();

		//get checked ingredients
		$('#div_ingredients input:checked').each(function() {
		    ingredients.push($(this).attr('id'));
		});

		//get checked accessories
		$('#div_accessories input:checked').each(function() {
		    accessories.push($(this).attr('id'));
		});			

		//get checked accessories
		$('#div_customOrders input:checked').each(function() {
		    customOptions.push($(this).attr('id'));
		});		

		//get checked accessories
		$('#div_defaults input:checked').each(function() {
		    defaults.push($(this).attr('id'));
		});			



		// post order ajax
		$.ajax({
			method: 'POST',
			url: APP_URL + '/ajax/postOrder',
			cache: false,
	        beforeSend: function (xhr) {
	            if (token) {
	                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
	            }
	        },										
			data: { _token: token, ingredients:ingredients, accessories:accessories, customOptions:customOptions, defaults:defaults, product_size_id: product_size, product_quantity: quantity },						
			datatype: 'JSON',
			success:function(data){
                console.log('post order success. says product_listing.js.');
            },error:function(){ 
                console.log('post order failed.  says product_listing.js.');
            }
		})
		.done(function(data){
			if(data == "error-1"){
				setTimeout(function(){
					window.location.href = APP_URL + '/500';
				},2000);							
				
				console.log('Exception thrown. Ajax post request had incompleted list of paramters.');	
			}else{
				console.log(data);
				window.location.href = redirect_url;
			}

		});	
		
	}



});
