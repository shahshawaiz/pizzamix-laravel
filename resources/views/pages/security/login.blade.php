@extends('layouts.shared.master')

<!-- title -->
@section('title')
  Login
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
  <script src="{{ URL::asset('js/app/validations.js') }}"></script>  

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

              {{ Form::open( array('url' => 'login', 'id'=>'form') ) }}

                  <div class="form-group">
                     {{ Form::email('email', null, ['placeholder'=>'Email Address', 'required'=>'true']) }}            
                     {{ Form::password('password', ['placeholder'=>'Password', 'required'=>'true']) }}
                 </div>        

                  <div class="form-group">
                     {{ Form::submit('Login', ['class'=>'button']) }}
                  </div> 

                  <div class="form-group">
                    @if( isset($message) )
                        <div class="alert alert-danger" role="alert">
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            <span class="sr-only">Warning:</span>
                            {{ $message }}
                        </div>

                    @endif
                  </div>

              {{ Form::close() }}




          </div>      
      </div>

      <div class="login-part2">

          <div class="login" style="text-align: center">

              <div class="form-group">
                 <h2>Register</h2>
              </div>

             {{ Form::open(array('url' => 'register')) }}

                  <div class="form-group">
                     {{ Form::text('name', null, ['placeholder'=>'Full Name', 'required'=>'true']) }} 

                     {{ Form::text('email', null, ['placeholder'=>'email', 'required'=>'true']) }} 
                      {{ Form::text('username', null, ['placeholder'=>'username', 'required'=>'true']) }}                             

                     {{ Form::password('password', ['placeholder'=>'password', 'required'=>'true'] ) }}

                 </div>                    

                  <div class="form-group">
                     {{ Form::submit('Register', ['class'=>'button'] ) }}
                  </div> 

                  <div class="form-group">
                    @if( isset($reg_message) )
                        <div class="alert alert-success" role="alert">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                            <span class="sr-only">Warning:</span>
                            {{ $reg_message }}
                        </div>

                    @endif
                  </div>                       

            {{ Form::close() }}

          </div>      
      </div>      
  </div>

@endsection

<!-- footer -->
@section('footer')

@endsection
