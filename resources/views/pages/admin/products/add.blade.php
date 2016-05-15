@extends('layouts.shared.master')

<!-- title -->
@section('title')
Add Product - Pizzamix
@endsection

<!-- stylesheets and directives -->
@section('head')

@endsection

<!-- header -->
@section('header')

@endsection

<!-- header -->
@section('assets')

  <link rel="stylesheet" type="text/css" href="{{ URL::asset('update_2/css/style.css') }}"/>
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('update_2/css/screen.css') }}"/>

@endsection


<!-- body -->

@section('body')

@include('layouts.admin.nav')

{{ Form::open( ['route' => 'product.store', 'files' => 'true' ] ) }}

  <div class="add-deal">
    <h1 >Add Product</h1>
    <img src="{{ URL::asset('images/divider.png') }}" alt="" style="padding-bottom: 50px">

    <div class="deal-add-part1" style="width: 40%">
      <h2>product thumbnail</h2>
      <div id="preview" class="featured-image" style="width: 100%">
        <p>click to upload</p>
      </div>
      <fieldset class="form-group">
          <small class="text-muted">Required dimensions are 100 x 100</small>         
      </fieldset>        

      <div style="display: none">
          <input type="file" id="thumbnail" name="thumbnail">             
      </div>

    </div>

    <div class="deal-add-part2 add-product" style="width: 58%">
        <fieldset class="form-group">
            <h2>Product Title:</h2>          
        </fieldset>


        <fieldset class="form-group">
            <label>Product Title:</label>          
            {{ Form::text('name' , null, ['class'=>'form-control', 'required'=>'true', 'placeholder'=>'Product Name']) }} 
            <small class="text-muted"></small>         
        </fieldset>

        <fieldset class="form-group">
            <label>Description:</label>          
            {{ Form::text('description' , null, ['class'=>'form-control', 'required'=>'true', 'placeholder'=>'Description']) }}
            <small class="text-muted"></small>         
        </fieldset>

        <fieldset class="form-group">
            <label>Category:</label>          
            {{ Form::select('category_id', $categories, null, ['class'=>'form-control' , 'required'=>'true', 'style'=>'width:100%', 'placeholder'=>'Please select a product' ]) }}
            <small class="text-muted"></small>         
        </fieldset>

        <fieldset class="form-group">
            <label>Available Options:</label>  
            <div class="row">
              <fieldset class="col-md-6">
                  Regular
                  {{ Form::number('product_prices[]', 0.00, ['class'=>'form-control', 'required'=>'true', 'min'=>0] ) }}         
              </fieldset>

              <fieldset class="col-md-6">
                  Large
                  {{ Form::number('product_prices[]', 0.00, ['class'=>'form-control', 'min'=>0] ) }}         
              </fieldset>              
            </div>
            <small class="text-muted">Non-Zero price will indicate availability of price</small>         
        </fieldset>


    </div>
    <div class="cb"></div>
  </div>
  
  <div class="cb"></div>

  <fieldset class="form-group">
    <div class="checkout-button" style="text-align: center">
      {{ Form::submit('Save' , [ 'class'=>'save btn btn-success'] ) }} 
      {{ Form::button('Reset' , [ 'class'=>'save btn btn-warning'] ) }} 
    </div>
  </fieldset>               

  
</div>

<script src="{{ URL::asset('js/app/preview_image.js') }}"></script>
 

{{ Form::close() }}


@endsection

<!-- footer -->
@section('footer')

@endsection