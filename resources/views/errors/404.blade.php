@extends('layouts.shared.master')

<!-- title -->
@section('title')
Error 404 - Pizzamix
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

@endsection


<!-- body -->

@section('body')
  

<div class="container jumbotron" style="min-height: 400px; display: block">
    <h1>Error 404!</h1>
    <p>We looked everywhere, but couldn't find your page :)</p>
</div>

@endsection

<!-- footer -->
@section('footer')

@endsection

