
$(document).ready(function(){

	$.ajaxSetup({ 
	 	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
	 	cache : false 
	 });

	//token for csrf protection
	var token = $('meta[name="csrf-token"]').attr('content');


	//-------------------------------------------------- Event Listners

   var filter_id, query_string, entity_type, entity_id;

   $(document).on('change', '#cuisine_id', function(){
      
      filter_id =  $('#cuisine_id').val(); 
      getProducts(filter_id);

   });

   $(document).on('change', '#query_string', function(){
      
      query_string =  $('#query_string').val(); 

      search(query_string);

   });   


	//-------------------------------------------------- function definitions

	function getProducts(filter_id){
		console.log(filter_id);
		// post order ajax
		$.ajax({
			method: 'POST',
			url: APP_URL + '/ajax/search_by_filter',
			cache: false,
	        beforeSend: function (xhr) {
	            if (token) {
	                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
	            }
	        },										
			data: { _token: token, filter_id: filter_id, item_type: 2  },						
			datatype: 'JSON'
		})
		.done(function(data){
			// console.log(data);
			$('.product-active').html(data);
		});	
	}

	function search(query_string){
		// post order ajax
		$.ajax({
			method: 'POST',
			url: APP_URL + '/ajax/search_by_name',
			cache: false,
	        beforeSend: function (xhr) {
	            if (token) {
	                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
	            }
	        },										
			data: { _token: token, query_string: query_string, item_type: 2 },						
			datatype: 'JSON'
		})
		.done(function(data){
			// console.log(data);
			$('.product-active').html(data);
		});	
	}

	function destroy(entity_type, entity_id){
		
		var post_url, redirect_url;

		// 1 = cuisine, 2=category, 3=product, 4=item
		switch(entity_type){
			case 1:
				post_url = APP_URL + '/cuisine/' + entity_id;
				redirect_url = APP_URL + '/cuisine';
				break;

			case 2:
				post_url = APP_URL + '/category/' + entity_id;
				redirect_url = APP_URL + '/category';
				break;

			case 3:
				post_url = APP_URL + '/product/' + entity_id;
				redirect_url = APP_URL + '/product';
				break;

			case 4:
				post_url = APP_URL + '/item/' + entity_id;
				redirect_url = APP_URL + '/item';
				break;

			default:
				return 0;																
		}

		//ajax delete request
		$.ajax({
			method: 'POST',
	        url: post_url,										
			data: { _token :token, _method: 'delete' },	
			success:function(data){
                console.log('delete success. says app_main.js.');
            },error:function(){ 
                console.log('delete failed.  says app_main.js.');
            }
		})
		.done(function(data){
			window.location.href = redirect_url;
		});	
	    	

	}

});
