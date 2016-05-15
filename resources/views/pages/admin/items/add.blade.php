@extends('layouts.shared.master')

<!-- title -->
@section('title')
      @if($type == 1)
         Add Ingredient        

      @elseif($type == 2)
         Add Accessory      

      @elseif($type == 3)
         Add Side Dish        

      @else
         Add Serving Item       
      @endif - Pizzamix
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

{{ Form::open( ['route' => 'item.store', 'files' => 'true' ] ) }}

  <div class="add-deal">
    <h1 >
      @if($type == 1)
         Add Ingredient        

      @elseif($type == 2)
         Add Accessory      

      @elseif($type == 3)
         Add Side Dish        

      @else
         Add Item       
      @endif
    </h1>
    <img src="{{ URL::asset('images/divider.png') }}" alt="" style="padding-bottom: 50px">

    <div class="deal-add-part1" style="width: 40%">
      <h2>Thumbnail</h2>
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

    <div class="deal-add-part2 add-product" style="width: 55%">
        <fieldset class="form-group">
            <h2>    
                @if($type == 1)
                   Ingredient Details        

                @elseif($type == 2)
                   Accessory Details      

                @elseif($type == 3)
                   Side Dish Details        

                @else
                   Item Details       
                @endif
            </h2>          
        </fieldset>


                <fieldset class="form-group">
                  {{ Form::text('name' , null, ['class'=>'form-control', 'placeholder'=>'Name']) }}         
                </fieldset>

                <fieldset class="form-group">
                  {{ Form::text('description' , null, ['class'=>'form-control', 'placeholder'=>'Description']) }}         
                </fieldset>


                  <fieldset class="form-group">
                      @if($type == 1)
                         {{ Form::text('type', "Ingredient", ['class'=>'form-control', 'readonly'=>'readonly']) }}        

                      @elseif($type == 2)
                         {{ Form::text('type', "Accessory", ['class'=>'form-control', 'readonly'=>'readonly']) }}        

                      @elseif($type == 3)
                         {{ Form::text('type', "Side Dish", ['class'=>'form-control', 'readonly'=>'readonly']) }}        

                      @else
                         {{ Form::select('type', array('1'=>'Ingredient', '2'=>'Accessory', '3'=>'Side Dish'), null
                      , ['class'=>'form-control', 'placeholder'=>'Please select item type']) }}        

                      @endif
                  </fieldset>

                  <fieldset class="form-group">
<!--                     {{ Form::label('price', 'Price') }}                      -->
                    {{ Form::number('price', 0.00, [ 
                                                      'min'=>1, 
                                                      'class'=>'form-control',
                                                      'data-toggle' => 'tooltip',
                                                      'data-placement' => 'left',
                                                      'title' => 'Price'
                                                    ]) 
                    }}        

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