@extends('layouts.shared.master')

<!-- title -->
@section('title')
Add Cuisine - Pizzamix
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

{{ Form::open( ['route' => 'cuisine.store', 'files' => 'true' ] ) }}


  <div class="add-deal">
    <h1 >Add Cuisine</h1>
    <img src="{{ URL::asset('images/divider.png') }}" alt="" style="padding-bottom: 50px">

    <div class="deal-add-part1" style="width: 40%">
      <h2>cuisine thumnial</h2>
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
            <h2>Cuisine Details:</h2>          
        </fieldset>


        <fieldset class="form-group">
            {{ Form::text('name' , null, ['class'=>'form-control', 'required'=>'true', 'placeholder'=>'Cuisine Name']) }} 
            <small class="text-muted"></small>         
        </fieldset>

        <fieldset class="form-group">
            {{ Form::text('description' , null, ['class'=>'form-control', 'required'=>'true', 'placeholder'=>'Description']) }}
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