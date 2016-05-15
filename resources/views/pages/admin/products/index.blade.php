@extends('layouts.shared.master')

<!-- title -->
@section('title')
Deals - Pizzamix
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
  

  <div class="product-gallery" ng-app="myApp">
    <div class="product-gallery-part">
      <div class="search-product">

        <div class="row product-search-part1">
          <div class="col-md-9">
            <label>Search</label>
          </div>

          <div class="col-md-3">
            <label>category</label>           
          </div>          
        </div>

        <div class="row">
          <div class="col-md-9">
            {{ Form::text('name' , null, ['id'=>'query_string', 'class'=>'form-control product-search', 'placeholder'=>'Product Name']) }}
          </div>

          <div class="col-md-3">
          {{ Form::select('category_id', $categories, null, ['id'=>'category_id', 'class'=>'form-control' , 'style'=>'width:100%' ]) }}                       
          </div>          
        </div>

        <div class="cb"></div>
      </div>
      <div class="cb"></div>
    </div>
    
    <div class="gallery-content">
      <h1>all products</h1>

      <div id="tabs">

        <div id="tabs-1" class="product-active">
        @if( count($products) > 0)
          @foreach($products as $product)

            <div class="cart-content">
              <div class="cart-info">
                <div class="cart-info-part1">              
                                
                <div class="list-image">
                  <img  src="{{asset('images/uploads/product/').'/'.$product->thumbnail}}">                  
                </div>                                
                  <a href="{{ route('product.show', $product->id ) }}"><h1>{{$product->name}}</h1></a>
                  <p>{{$product->description}}.</p>


                      @if($product->Product_Size != null)
                        <h2>  
                          <span>PRICE:</span>
                          @foreach($product->Product_Size as $item)
                                {{ $item->price }}-/ 
                                <?php break; ?>
                          @endforeach
                        </h2>                             
                      @else
                      @endif                 

                </div>
                
                <div class="cart-info-part2">
                  <a href="" id="delete" data-toggle="modal" data-target="#confirmDelete" data-type="3" data-id="{{$product->id}}" data-toggle="tooltip" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>

                  <a href="{{ route('product.show', $product->id ) }}" data-toggle="tooltip" title="Preview"><span class="glyphicon glyphicon-eye-open"></span></a>

                  <a href="{{ route('product.edit', $product->id ) }}" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
                </div>
                <div class="cb"></div>
              </div>
              <div class="cb"></div>
            </div>
          @endforeach

        @else
          <p>No results found!!</p>
        @endif
    
        </div>
        
      </div>
      
    </div>

  </div>

  @include('pages.admin.partials.confirm_modal')

<script src="{{ URL::asset('js/app/confirm_modal.js') }}"></script>
<script src="{{ URL::asset('js/app/app.js') }}"></script>
<script src="{{ URL::asset('js/app/list_product.js') }}"></script>

@endsection

<!-- footer -->
@section('footer')

@endsection
