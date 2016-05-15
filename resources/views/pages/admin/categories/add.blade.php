@extends('layouts.shared.master')

<!-- title -->
@section('title')
Add Category - Pizzamix
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

{{ Form::open( ['route' => 'category.store', 'files' => 'true' ] ) }}

  <div class="add-deal">
    <h1 >Add Category</h1>
    <img src="{{ URL::asset('images/divider.png') }}" alt="" style="padding-bottom: 50px">

    <div class="deal-add-part1" style="width: 100%">
      <h2>Category header</h2>
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



    <div class="deal-add-part2 add-product" style="width: 100%">
        <fieldset class="form-group">
            <h2>Category Details:</h2>          
        </fieldset>


        <fieldset class="form-group">       
            {{ Form::text('name' , null, ['class'=>'form-control', 'placeholder'=>'Product Name', 'required'=>'true']) }} 
            <small class="text-muted"></small>         
        </fieldset>

        <fieldset class="form-group">       
            {{ Form::text('description' , null, ['class'=>'form-control', 'placeholder'=>'Description', 'required'=>'true']) }}
            <small class="text-muted"></small>         
        </fieldset>

        <fieldset class="form-group">     
            {{ Form::select('cuisine_id', $cuisines, null, ['class'=>'form-control', 'style'=>'width:100%', 'placeholder'=>'Please select a cuisine', 'required'=>'true']) }}
            <small class="text-muted"></small>         
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
