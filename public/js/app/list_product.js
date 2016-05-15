
$(document).ready(function(){

	$.ajaxSetup({ 
	 	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
	 	cache : false 
	 });

	//token for csrf protection
	var token = $('meta[name="csrf-token"]').attr('content');


	//-------------------------------------------------- Event Listners

   var filter_id, query_string;

   $(document).on('change', '#category_id', function(){
      
      filter_id =  $('#category_id').val(); 
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
			data: { _token: token, filter_id: filter_id, item_type: 3  },						
			datatype: 'JSON'
		})
		.done(function(data){
			// console.log(data);
			$('.product-active').html(data);
		});	
	}

	function search(query_string){
		console.log(query_string);
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
			data: { _token: token, query_string: query_string, item_type: 3 },						
			datatype: 'JSON'
		})
		.done(function(data){
			// console.log(data);
			$('.product-active').html(data);
		});	
	}


});

