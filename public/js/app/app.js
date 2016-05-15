
function confirmed(){
	$('#delete').trigger('change');
}

$(document).ready(function(){

	$.ajaxSetup({ 
	 	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
	 	cache : false 
	 });

	//token for csrf protection
	var token = $('meta[name="csrf-token"]').attr('content');


	//-------------------------------------------------- Event Listners

   var entity_type, entity_id;     

   $(document).on('click', '#delete', function(){
     
   	  // tag clicked item
      $(this).addClass('clicked_element');  

   }); 

   $(document).on('change', '#delete', function(){
    
    //find tagged item
	var clicked_element = $('.product-active').find('.clicked_element');

 	entity_type = $(clicked_element).data("type");
 	entity_id = $(clicked_element).data("id"); 	

 	destroy(entity_type, entity_id);

 	//reset tag
    $(clicked_element).removeClass('clicked_element');

   });    

   //smooth scroll 
	$(document).on('click', 'a[href^="#"]', function(e) {
	    // target element id
	    var id = $(this).attr('href');

	    // target element
	    var $id = $(id);
	    if ($id.length === 0) {
	        return;
	    }

	    // prevent standard hash navigation (avoid blinking in IE)
	    e.preventDefault();

	    // top position relative to the document
	    var pos = $(id).offset().top;

	    // animated top scrolling
	    $('body, html').animate({scrollTop: pos}, 1200);
	});

	//-------------------------------------------------- function definitions

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

