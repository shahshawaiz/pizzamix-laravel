
$(document).ready(function(){

	$.ajaxSetup({ 
	 	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
	 	cache : false 
	 });

	//token for csrf protection
	var token = $('meta[name="csrf-token"]').attr('content');


	//-------------------------------------------------- Event Listners

   var product_id, item_id, item_type;

   $(document).on('change', '#product_id', function(){
      
      product_id =  $('#product_id').val(); 

      getProductItems(product_id);

   });

   $(document).on('click', '.btnAdd1', function(){
      
      product_id =  $('#product_id').val(); 
      item_id =  $('#ingredient_id').val(); 
      item_type = 1;
      
      insertItem(product_id, item_id);

   });

   $(document).on('click', '.btnAdd2', function(){
      
      product_id =  $('#product_id').val(); 
      item_id =  $('#accessory_id').val(); 
      item_type = 2;

      insertItem(product_id, item_id);

   });

   $(document).on('click', '.btnAdd3', function(){
      
      product_id =  $('#product_id').val(); 
      item_id =  $('#side_dish_id').val(); 
      item_type = 3;
      
      insertItem(product_id, item_id);      

   });   

   $(document).on('click', '.btnAdd4', function(){
      
      product_id =  $('#product_id').val(); 
      item_id =  $('#default_id').val(); 
      item_type = 4;
      
      insertItem(product_id, item_id);      

   });  

	//-------------------------------------------------- function definitions

	function insertItem(){
	
		// post order ajax
		$.ajax({
			method: 'POST',
			url: APP_URL + '/ajax/post_listing_item',
			cache: false,
	        beforeSend: function (xhr) {
	            if (token) {
	                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
	            }
	        },										
			data: { _token: token, product_id: product_id, item_id:item_id, item_type: item_type },						
			datatype: 'JSON',
			success:function(data){
                console.log('post order success. says post_listing_js.js.');
            },error:function(){ 
                console.log('post order failed.  says post_listing_js.js.');
            }
		})
		.done(function(data){
			console.log(data);
			getProductItems(product_id);
		});	
	}

	function getProductItems(){
	
		// post order ajax
		$.ajax({
			method: 'POST',
			url: APP_URL + '/ajax/get_product_items',
			cache: false,
	        beforeSend: function (xhr) {
	            if (token) {
	                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
	            }
	        },										
			data: { _token: token, product_id: product_id },						
			datatype: 'JSON',
			success:function(data){
                console.log('post order success. says post_listing_js.js.');
            },error:function(){ 
                console.log('post order failed.  says post_listing_js.js.');
            }
		})
		.done(function(data){
			console.log(data);

			$('.div-ingredients').html(data[0]);
			$('.div-accessories').html(data[1]);
			$('.div-side-dishes').html(data[2]);
			$('.div-default-servings').html(data[3]);			
		});	
	}	



});
