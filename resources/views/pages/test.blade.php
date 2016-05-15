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

  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/login.css') }}"/>
  <script src="{{ URL::asset('js/prefixfree.min.js') }}"></script>

@endsection


<!-- body -->

@section('body')
  
  <div class="body"></div>

  <div class="container login-container">

      <div class="login-part1">

          <div class="login" style="text-align: center">
              <div class="form-group">
                 <h2>Login</h2>
              </div>

              <div class="form-group">
                <input type="text" placeholder="username" name="user"><br>
                <input type="password" placeholder="password" name="password"><br>
              </div>        

              <div class="form-group">
                <input type="button" value="Login">
              </div>        

          </div>      
      </div>

      <div class="login-part2">

          <div class="login" style="text-align: center">

              <div class="form-group">
                 <h2>Register</h2>
              </div>

              <div class="form-group">
                <input type="text" placeholder="username" name="user"><br>
                <input type="password" placeholder="password" name="password"><br>
              </div>        

              <div class="form-group">
                <input type="button" value="Login">
              </div>        

          </div>      
      </div>      
  </div>

@endsection

<!-- footer -->
@section('footer')

@endsection
