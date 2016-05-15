@extends('layouts.shared.master')

<!-- title -->
@section('title')
Cuisines - Pizzamix
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
          <div class="col-md-12">
            <label>Search</label>
          </div>

        </div>

        <div class="row">
          <div class="col-md-12">
            {{ Form::text('name' , null, ['id'=>'query_string', 'class'=>'form-control product-search', 'placeholder'=>'Cuisine Name']) }}
          </div>
        </div>

        <div class="cb"></div>
      </div>
      <div class="cb"></div>
    </div>
    
    <div class="gallery-content">
      <h1>all cuisines</h1>

      <div id="tabs">

        <div id="tabs-1" class="product-active">
        @if( count($cuisines) > 0)
          @foreach($cuisines as $cuisine)

            <div class="cart-content">
              <div class="cart-info">

                <div class="cart-info-part1">              
                                
                <div class="list-image">
                  <img  src="{{asset('images/uploads/cuisine/').'/'.$cuisine->thumbnail}}">                  
                </div>                                
                  <a href="{{ route('cuisine.show', $cuisine->id ) }}"><h1>{{$cuisine->name}}</h1></a>
                  <p>{{$cuisine->description}}.</p>

                </div>

                <div class="cart-info-part2">
                  <a href="" id="delete" data-toggle="modal" data-target="#confirmDelete" data-type="1" data-id="{{$cuisine->id}}" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>

                  <a href="{{ route('cuisine.show', $cuisine->id ) }}" data-toggle="tooltip" title="Preview"><span class="glyphicon glyphicon-eye-open"></span></a>

                  <a href="{{ route('cuisine.edit', $cuisine->id ) }}" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
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
<script src="{{ URL::asset('js/app/list_cuisine.js') }}"></script>

@endsection

<!-- footer -->
@section('footer')

@endsection