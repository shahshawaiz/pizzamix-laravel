@extends('layouts.shared.master')

<!-- title -->
@section('title')
  Testing layout
@endsection

<!-- stylesheets and directives -->
@section('head')

@endsection

<!-- header -->
@section('header')

@endsection

<!-- header -->
@section('assets')

@endsection


<!-- body -->

@section('body')

  <div style="display:block; padding-top: 20px; padding-bottom: 20px">

    <div class="container div-orders">

            <h2 class="title">Order requests</h2>

            <h4>Customer Information</h4>
            <p>Name: {{ $order->get() }}</p>


            
  <script type="text/javascript">

    $(document).ready(function(){

       $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
       });


      $('.btnUpdateStatus').on('click', function(){

        console.log("clicked");

        var token = $('meta[name="csrf-token"]').attr('content');
        var order_id =  $(this).val();

        $.ajax({
          method: 'POST',
          cache: false,
          url: '/laravel/pizzamix/public/ajax/updateStatus',
              beforeSend: function (xhr) {
                  if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                  }
              },                    
          data: { _token: token, order_id: order_id },            
          datatype: 'JSON',
          success:function(data){
                    console.log('ajax call succeeded');
                },error:function(){ 
                    console.log('ajax call failed');
                }
        })
        .done(function(data){
          console.log(data);
          $('#div_pending_acknowledgment').load(location.href + ' #div_pending_acknowledgment');
          $('.div-orders').load(location.href + ' .div-orders');

        });     


      });



    });

  </script>
    </div>
  </div>


@endsection

<!-- footer -->
@section('footer')

@endsection







<!--             <div class="content">
                <h2>Admin's Home</h2>

                <a href="{{ route('cuisine.index' ) }}">Cuisine CRUD</a> <br/>
                <a href="{{ route('category.index' ) }}">Category CRUD</a> <br/>                
                <a href="{{ route('product.index' ) }}">Products CRUD</a> <br/>
                <a href="{{ route('ingredient.index' ) }}">Ingredient CRUD</a> <br/>                
                <a href="{{ route('accessory.index' ) }}">Accessory CRUD</a> <br/>                                

                
            </div> -->
