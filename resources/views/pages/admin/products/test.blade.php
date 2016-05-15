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

  <link rel="stylesheet" type="text/css" href="{{ URL::asset('update_2/css/style.css') }}"/>
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('update_2/css/screen.css') }}"/>

  <link href='https://fonts.googleapis.com/css?family=Roboto:400,500,700' rel='stylesheet' type='text/css'>
  
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
@endsection


<!-- body -->

@section('body')

@include('layouts.admin.nav')

{{ Form::open( ['route' => 'product.store', 'files' => 'true' ] ) }}

  <div class="add-deal">
    <h1 >add products</h1>
    <img src="images/divider.png" alt="" style="padding-bottom: 50px">

    <div class="deal-add-part1" style="width: 40%">
      <h2>product image</h2>
      <div id="preview" class="featured-image" style="width: 100%">
        <p>Thumbnail Preview</p>
      </div>
    </div>

    <div class="deal-add-part2 add-product" style="width: 58%">
      <h2>Product Details</h2>
        <p>
          <label>Product Title:</label>
          {{ Form::text('name' , null, ['class'=>'form-control', 'placeholder'=>'Product Name']) }}  
        </p>
        <p>
          <label>Description:</label>
          {{ Form::text('description' , null, ['class'=>'form-control', 'placeholder'=>'Description']) }}
        </p>
        <p>
          <label>Category:</label>
          {{ Form::select('category_id', $categories, null, ['class'=>'form-control' , 'style'=>'width:100%' ]) }}   
        </p>        
        <p class="size">
          <label>Available Options:</label>  
        </p>
        <p class="price">
            <div class="row col-md-12">
              <fieldset class="form-group col-md-6">
                  Regular {{ Form::checkbox('product_sizes[]', 1) }}
                  {{ Form::number('product_prices[]', 0.00, ['class'=>'form-control', 'min'=>0] ) }}         
              </fieldset>

              <fieldset class="form-group col-md-6">
                  Large {{ Form::checkbox('product_sizes[]', 2) }}   
                  {{ Form::number('product_prices[]', 0.00, ['class'=>'form-control', 'min'=>0]) }}                         
              </fieldset>
            </div>
        </p>

        <div class="row">
          <fieldset class="form-group col-md-4">
            {{ Form::label('thumbnail', 'Thumbnail Image') }}                
            {{ Form::file('thumbnail' , null, ['class'=>'form-control-file', 'placeholder'=>'thumbnail']) }} 
            <small class="text-muted">required dimensions are 100x100</small>         
          </fieldset>

          <fieldset class="form-group col-md-4">
            {{ Form::label('header', 'Header') }}
            {{ Form::file('header' , null, ['class'=>'form-control-file', 'placeholder'=>'header']) }}  
            <small class="text-muted">required dimensions are 100x100</small>         
          </fieldset>

          <fieldset class="form-group col-md-4">
            {{ Form::label('headerStrip', 'Header Strip') }}
            {{ Form::file('headerStrip' , null, ['class'=>'form-control-file', 'placeholder'=>'headerStrip']) }}          
            <small class="text-muted">required dimensions are 100x100</small> 
          </fieldset>                  
        </div>        

    </div>
    <div class="cb"></div>
  </div>
  
  <div class="cb"></div>
  
  <div class="checkout-button" style="text-align: center">
    {{ Form::submit('Save' , [ 'class'=>'save btn btn-success'] ) }} 
<!--     <input type="submit" value="INACTIVE" class="inactive">
    <input type="submit" value="SAVE" class="save">
    <input type="submit" value="UPLOAD" class="upload"> -->
  </div>
</div>


<script src="{{ URL::asset('js/app/preview_image.js') }}"></script>



{{ Form::close() }}


@endsection

<!-- footer -->
@section('footer')

@endsection