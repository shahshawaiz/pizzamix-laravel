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
            <div class="content">

                <h1>{{ $cuisine->name }}</h1>

                    <div class="row col-md-4"><h4>Cuisine Code: {{ $cuisine->cuisineCode }}</h4></div><br>
                    <div class="row col-md-4"><h4>Description: {{ $cuisine->description }}</h4></div>  <br>                  
                    <div class="row col-md-4"><h4>URL: {{ $cuisine->url }}</h4></div>        <br>                                

                </div>

            </div>
        </div>

  </div>


@endsection

<!-- footer -->
@section('footer')

@endsection
