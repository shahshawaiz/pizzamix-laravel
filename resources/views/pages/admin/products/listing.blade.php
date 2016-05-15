@extends('layouts.shared.master')

<!-- title -->
@section('title')
Product Listing - Pizzamix
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

@include('layouts.admin.nav')
  
<div style="display:block;padding-top: 30px; padding-bottom: 300px">
    <div class="container">
        <div class="content">
            <h1>Product Listing Updatation</h1>
            
            <br>
            
            <div class="col-md-12" style="align-content: center">

                <fieldset class="form-group">
                    {{ Form::select('product_id', $products, null, ['id'=>'product_id', 'class'=>'form-control', 'placeholder'=>'Please select a product']) }}         
                </fieldset>             


                <div class="row">
 
                  <fieldset class="form-group col-md-3">
                    <fieldset class="col-md-12">
                      {{ Form::label('product_listing', 'Ingredients') }}  
                    </fieldset>
                    <fieldset class="col-md-10">
                        {{ Form::select('ingredient_id', $ingredients, null, ['id'=>'ingredient_id', 'class'=>'form-control', 'placeholder'=>'select ingredients']) }}  
                    </fieldset>

                    <fieldset class="col-md-2">
                        {{ Form::button('', array('class' => 'btnAdd1 btn btn-success btn-sm glyphicon glyphicon-plus')) }}  
                    </fieldset>  

                    <fieldset class="col-md-12" style="padding-top: 5px">
                        <div class="ingredients-subpart" style="width: 80%">
                            <div class="ingredients-info header-info">
                                <div class="ingredients-subpart-content"  style="margin-left: 10px">
                                  <p style="font-size:8pt" class="ingredients-subpart-content-heading">Ingredients</p>
                                </div>
                            </div>

                              <div class="ingredients-info">
                                  <div id="div_accessories" class="ingredients-subpart-content" style="margin-left: 10px">
                                       <div class="div-ingredients">
                                          <!-- ajax will append html here -->
                                       </div>           
                                      <div class="cb"></div>
                                  </div>
                              </div>
                        </div>                                 
                    </fieldset>    

                  </fieldset>    

                  <fieldset class="form-group col-md-3">
                    <fieldset class="col-md-12">
                      {{ Form::label('product_listing', 'Accessories') }}  
                    </fieldset>
                    <fieldset class="col-md-10">
                        {{ Form::select('accessory_id', $accessories, null, ['id'=>'accessory_id', 'class'=>'form-control', 'placeholder'=>'select accessories']) }}
                    </fieldset>
                    <fieldset class="col-md-2">
                        {{ Form::button('', array('class' => 'btnAdd2 btn btn-success btn-xm glyphicon glyphicon-plus')) }}  
                    </fieldset>      
                    <fieldset class="col-md-12" style="padding-top: 5px">
                        <div class="ingredients-subpart" style="width: 80%">
                            <div class="ingredients-info header-info">
                                <div class="ingredients-subpart-content"  style="margin-left: 10px">
                                  <p style="font-size:8pt" class="ingredients-subpart-content-heading">Accessories</p>
                                </div>
                            </div>

                              <div class="ingredients-info">
                                  <div id="div_accessories" class="ingredients-subpart-content" style="margin-left: 10px">
                                         <div class="div-accessories">
                                            <!-- ajax will append html here -->
                                         </div>        
                                      <div class="cb"></div>
                                  </div>
                              </div>
                        </div>                                 
                    </fieldset>                                                          
                  </fieldset>   

                  <fieldset class="form-group col-md-3">
                    <fieldset class="col-md-12">
                      {{ Form::label('product_listing', 'Side Dishes') }}  
                    </fieldset>
                    <fieldset class="col-md-10">
                        {{ Form::select('side_dish_id', $sideDishes, null, ['id'=>'side_dish_id', 'class'=>'form-control', 'placeholder'=>'select side dishes']) }}
                    </fieldset>
                    <fieldset class="col-md-2">
                        {{ Form::button('', array('class' => 'btnAdd3 btn btn-success btn-xm glyphicon glyphicon-plus')) }}  
                    </fieldset>      
                    <fieldset class="col-md-12" style="padding-top: 5px">
                        <div class="ingredients-subpart" style="width: 80%">
                            <div class="ingredients-info header-info">
                                <div class="ingredients-subpart-content"  style="margin-left: 10px">
                                  <p style="font-size:8pt" class="ingredients-subpart-content-heading">Side Dishes</p>
                                </div>
                            </div>

                              <div class="ingredients-info">
                                  <div id="div_accessories" class="ingredients-subpart-content" style="margin-left: 10px">
                                         <div class="div-side-dishes">
                                            <!-- ajax will append html here -->
                                         </div>                                                                   
                                      <div class="cb"></div>
                                  </div>
                              </div>
                        </div>                                 
                    </fieldset>   
                  </fieldset>                     
     
                  <fieldset class="form-group col-md-3">
                    <fieldset class="col-md-12">
                      {{ Form::label('product_listing', 'Default Serving Items') }}  
                    </fieldset>
                    <fieldset class="col-md-10">
                        {{ Form::select('default_id', $defaults, null, ['id'=>'default_id', 'class'=>'form-control', 'placeholder'=>'select default serving itmes']) }}
                    </fieldset>
                    <fieldset class="col-md-2">
                        {{ Form::button('', array('class' => 'btnAdd4 btn btn-success btn-xm glyphicon glyphicon-plus')) }}  
                    </fieldset>      
                    <fieldset class="col-md-12" style="padding-top: 5px">
                        <div class="ingredients-subpart" style="width: 80%">
                            <div class="ingredients-info header-info">
                                <div class="ingredients-subpart-content"  style="margin-left: 10px">
                                  <p style="font-size:8pt" class="ingredients-subpart-content-heading">Default Servings</p>
                                </div>
                            </div>

                              <div class="ingredients-info">
                                  <div id="div_accessories" class="ingredients-subpart-content" style="margin-left: 10px">
                                         <div class="div-default-servings">
                                            <!-- ajax will append html here -->
                                         </div>                                                
                                      <div class="cb"></div>
                                  </div>
                              </div>
                        </div>                                 
                    </fieldset>                                                                           
                  </fieldset>                     
     


                </div>


 
              
            </div>


        </div>
    </div>

</div>

<script src="{{ URL::asset('js/app/post_listing_item.js') }}"></script>

@endsection

<!-- footer -->
@section('footer')

@endsection
