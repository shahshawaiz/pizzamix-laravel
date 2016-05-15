@extends('layouts.shared.master')

<!-- title -->
@section('title')
Dashboard - Pizzamix
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
          
<div style="display:block; padding-top: 20px; padding-bottom: 200px">

  <div class="container ">

      <div class="item-ingredients-part">
          <h1 >Order Requests</h1>

          @include('pages.admin.partials.table')
      </div>

  </div>
</div>


<!-- load javascript for event listners  -->
<script src="{{ URL::asset('js/app/order_list.js') }}"></script>

@endsection

<!-- footer -->
@section('footer')

@endsection
