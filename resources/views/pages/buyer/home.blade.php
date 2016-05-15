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

@include('layouts.buyer.nav')

<div style="display:block; padding-top: 20px; padding-bottom: 200px">

<div class="container div-orders">

        <h2 class="title">Your Order requests</h2>

        @include('pages.buyer.partials.table')


</div>
</div>

<!-- load javascript for event listners  -->
<script src="{{ URL::asset('js/app/order_list.js') }}"></script>


@endsection

<!-- footer -->
@section('footer')

@endsection