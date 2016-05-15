$(document).ready(function(){

   $.ajaxSetup({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
   });

   //hide all divs
    // $('.pending_acknowledgments').hide();
    // $('.acknowledged').hide();
    // $('.approved').hide();
    // $('.dispatched').hide();
    // $('.delivered').hide();
    // $('.disapproved').hide();    
    // $('.cancelled').hide();                                                         

   var order_id, order_status;

   $(document).on('click', '.btnAcknowledge', function(){
      var order_id =  $(this).val();      
      var order_status =  1; 

      updateStatus(order_id, order_status);
   });

   $(document).on('click', '.btnApprove', function(){
      var order_id =  $(this).val();      
      var order_status =  2;  

      updateStatus(order_id, order_status);
   });

   $(document).on('click', '.btnDispatch', function(){
      var order_id =  $(this).val();      
      var order_status =  3;  

      updateStatus(order_id, order_status);
   });

   $(document).on('click', '.btnDeliverd', function(){
      var order_id =  $(this).val();      
      var order_status =  4; 

      updateStatus(order_id, order_status);
   });

   $(document).on('click', '.btnDisapprove', function(){
      var order_id =  $(this).val();      
      var order_status =  5;  

      updateStatus(order_id, order_status);
   });  

   $(document).on('click', '.btnCancel', function(){
      var order_id =  $(this).val();      
      var order_status =  6;   

      updateStatus(order_id, order_status);
   });         

   $(document).on('click', '.btnArchive', function(){
      var order_id =  $(this).val();      
      var order_status =  7;   

      updateStatus(order_id, order_status);
   });         
    


   function updateStatus(order_id, order_status, div){

      console.log(order_id);
      var token = $('meta[name="csrf-token"]').attr('content');
    
      $.ajax({
        method: 'POST',
        cache: false,
        url: APP_URL + '/ajax/updateStatus',
            beforeSend: function (xhr) {
                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },                    
        data: { _token: token, order_id: order_id , order_status : order_status},            
        datatype: 'JSON',
        success:function(data){
                  console.log('ajax call succeeded');
              },error:function(){ 
                  console.log('ajax call failed');
              }
      })
      .done(function(data){

        $('.pending_acknowledgments').load(location.href + ' .pending_acknowledgments');
        $('.acknowledged').load(location.href + ' .acknowledged');
        $('.approved').load(location.href + ' .approved');
        $('.dispatched').load(location.href + ' .dispatched');
        $('.delivered').load(location.href + ' .delivered');
        $('.disapproved').load(location.href + ' .disapproved');        
        $('.cancelled').load(location.href + ' .cancelled');                                                         

      });

   }

   //----------------------------------hide / unhide

   $(document).on('click', '.pending_acknowledgments_visiblity', function(){

      if( $(this).hasClass("hide.") ){
        $(".pending_acknowledgments").show(1000); 

        $(this).addClass('show.');
        $(this).removeClass('hide.');   
        $(this).text('Hide');           

      }else if( $(this).hasClass("show.") ){

        $(".pending_acknowledgments").hide(1000);  

        $(this).addClass('hide.');
        $(this).removeClass('show.');   
        $(this).text('Show');           

      }

   });

   $(document).on('click', '.acknowledged_visiblity', function(){

      if( $(this).hasClass("hide.") ){
        $(".acknowledged").show(1000); 

        $(this).addClass('show.');
        $(this).removeClass('hide.');   
        $(this).text('Hide');           

      }else if( $(this).hasClass("show.") ){

        $(".acknowledged").hide(1000);  

        $(this).addClass('hide.');
        $(this).removeClass('show.');   
        $(this).text('Show');           

      }

   });

   $(document).on('click', '.approved_visiblity', function(){

      if( $(this).hasClass("hide.") ){
        $(".approved").show(1000); 

        $(this).addClass('show.');
        $(this).removeClass('hide.');   
        $(this).text('Hide');           

      }else if( $(this).hasClass("show.") ){

        $(".approved").hide(1000);  

        $(this).addClass('hide.');
        $(this).removeClass('show.');   
        $(this).text('Show');           

      }

   });

   $(document).on('click', '.dispatched_visiblity', function(){

      if( $(this).hasClass("hide.") ){
        $(".dispatched").show(1000); 

        $(this).addClass('show.');
        $(this).removeClass('hide.');   
        $(this).text('Hide');           

      }else if( $(this).hasClass("show.") ){

        $(".dispatched").hide(1000);  

        $(this).addClass('hide.');
        $(this).removeClass('show.');   
        $(this).text('Show');           

      }

   });

   $(document).on('click', '.delivered_visiblity', function(){

      if( $(this).hasClass("hide.") ){
        $(".delivered").show(1000); 

        $(this).addClass('show.');
        $(this).removeClass('hide.');   
        $(this).text('Hide');           

      }else if( $(this).hasClass("show.") ){

        $(".delivered").hide(1000);  

        $(this).addClass('hide.');
        $(this).removeClass('show.');   
        $(this).text('Show');           

      }

   });

   $(document).on('click', '.disapproved_visiblity', function(){

      if( $(this).hasClass("hide.") ){
        $(".disapproved").show(1000); 

        $(this).addClass('show.');
        $(this).removeClass('hide.');   
        $(this).text('Hide');           

      }else if( $(this).hasClass("show.") ){

        $(".disapproved").hide(1000);  

        $(this).addClass('hide.');
        $(this).removeClass('show.');   
        $(this).text('Show');           

      }

   });               

   $(document).on('click', '.cancelled_visiblity', function(){

      if( $(this).hasClass("hide.") ){
        $(".cancelled").show(1000); 

        $(this).addClass('show.');
        $(this).removeClass('hide.');   
        $(this).text('Hide');           

      }else if( $(this).hasClass("show.") ){

        $(".cancelled").hide(1000);  

        $(this).addClass('hide.');
        $(this).removeClass('show.');   
        $(this).text('Show');           

      }

   });
    
});