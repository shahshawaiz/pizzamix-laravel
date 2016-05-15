@extends('layouts.shared.master')

<!-- title -->
@section('title')
  Testing layout
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

  <div style="height: 500px;padding-top: 10px">

    <div class="container">

      <h2>Thanks for registering</h2>
      <p>You have successfully logged out. <a href=" {{ URL::to('login') }} ">Login?</a> </p> 
      
    </div>
  </div>


@endsection

<!-- footer -->
@section('footer')

@endsection