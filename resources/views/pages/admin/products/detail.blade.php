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

  @include('layouts.shared.nav')
  
  <div style="height: 500px;padding-top: 10px">
        <div class="container">
            <div class="content">

                <h1>Add Category</h1>

                <div class="row col-md-4">
                   {{ $product->name }}
                </div>
                <div class="row col-md-4">
                   {{ $product->description }}
                </div>

                </div>

            </div>
        </div>

  </div>


@endsection

<!-- footer -->
@section('footer')

@endsection
