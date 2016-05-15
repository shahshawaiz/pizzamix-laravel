@extends('layouts.shared.master')

<!-- title -->
@section('title')
Serving Items - Pizzamix
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
            {{ Form::text('name' , null, ['id'=>'query_string', 'class'=>'form-control product-search', 'placeholder'=>'Item Name']) }}
          </div>
        </div>

        <div class="cb"></div>
      </div>
      <div class="cb"></div>
    </div>
    
    <div class="gallery-content">
      <h1>all items</h1>

      <div id="tabs">

        <div id="tabs-1" class="product-active">
        @if( count($items) > 0)
          @foreach($items as $item)

            <div class="cart-content">
              <div class="cart-info">

                <div class="cart-info-part1">              
                                 
                  <div class="list-image">
                    <img  src="{{asset('images/uploads/item/').'/'.$item->thumbnail}}">                  
                  </div>                                

                  <a href="{{ route('category.show', $item->id ) }}"><h1>{{$item->name}}</h1></a>
                  <p>{{$item->description}}.</p>

                </div>

                <div class="cart-info-part2">
                  <a href="" id="delete" data-toggle="modal" data-target="#confirmDelete" data-type="4" data-id="{{$item->id}}" data-toggle="tooltip" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>

                  <a href="{{ route('item.edit', $item->id ) }}" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
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
<script src="{{ URL::asset('js/app/list_item.js') }}"></script>

@endsection

<!-- footer -->
@section('footer')

@endsection
