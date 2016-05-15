<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Welcome to Pizzamix</title>

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/screen.css') }}"/>

    <!-- jquery -->
    <script src="{{ URL::asset('js/lib/jquery/jquery.min.js') }}"></script>

    <!-- bootstrap CSS -->
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">

    <!-- bootstrap JS -->
    <script src="{{ URL::asset('js/lib/bootstrap/bootstrap.min.js') }}"></script>

     <!-- google fonts -->
    <link href="{{ URL::asset('fonts/google-fonts.css') }}" rel="stylesheet" type="text/css">

    <!-- other scripts -->
    <script src="{{ URL::asset('js/app/app.js') }}"></script> 

    <!-- responsive content view -->
    <meta name="viewport" content="width=device-width, initial-scale=1">


</head>
<body>

    <header>
        <div class="home-header">
            <div class="home-header-subpart">
                <div class="header-info1">
                    <a href="{{ URL::route('home') }}"><img src="{{ URL::asset('images/logo.png') }}" alt=""></a>
                    <p>
                        <img src="{{ URL::asset('images/phone.png') }}" alt="">
                        <span>22 666 999</span>
                    </p>
                    <div class="cb"></div>
                </div>
                <div class="header-info2">
                    <ul>

                    <li><a href="{{ route('home' ) }}">Home</a></li>
                    <li><a href="#menu">menu</a></li>
                    <li><a href="{{ route('about' ) }}">About</a></li>
                    <li><a href="{{ route('contact' ) }}">Contact</a></li>                      

                    @if(Auth::check() == false) 
                        <li><a href="{{ route('login' ) }}">Login</a></li>
                        <li>
                            <a href="{{ route('cart' ) }}">
                                <img src="{{ URL::asset('images/cart.png') }}" alt="">
                            </a>
                        </li>

                    @else
                       @if(Auth::user()['accountType'] == 1)
                            <li><a href="{{ route('admin/dashboard' ) }}">{{Auth::user()->username}}</a></li>
                       @elseif(Auth::user()['accountType'] == 2)
                            <li><a href="{{ route('buyer/dashboard' ) }}">{{Auth::user()->username}}</a></li>
                       @else(Auth::user()['accountType'] == 3)
                           <li><a href="{{ route('kitchen/dashboard' ) }}">{{Auth::user()->username}}</a></li>
                       @endif
                       
                        <li><a href="{{ route('getLogout' ) }}">Logout</a></li>     
                                                             

                    @endif  

                    </ul>
                    <div class="cb"></div>
                </div>
                <div class="cb"></div>
            </div>
            
            <div class="home-header-detail">
                <h1>THE TASTE YOU</h1>
                <h2>LOVE THE MOST</h2>
                <div class="header-detail-part">
                    <p class="menu-btn"><a href="http://www.pizzamix.no/images/Pizza%20Mix%20PDF.pdf">download menu</a></p>
                    <p class="location-btn"><a href="https://www.google.com/maps/place/Pizzamix+Gamlebyen/@59.9018897,10.7866518,17z/data=!3m1!4b1!4m2!3m1!1s0x46416efdcc62d9b1:0x207f46c8312730f9">view location</a></p>
                    <div class="cb"></div>
                </div>
            </div>
        </div>
    </header>
    
    <div id="menu" class="menu-bg">
        <div class="home-menu">

            @foreach ($cuisines as $cuisine)
                <div class="menu-content" style="background-image: url({{asset('images/uploads/cuisine/').'/'.$cuisine->thumbnail}})">
                    <div class="menu-1">
                        <div class="menu-1-info">
                            <!-- <span>{{ $cuisine->name }}</span> -->
                        </div>
                        
                    </div>

                    <div class="menu-part1">
                        
                        <ul>
                            @foreach($cuisine->Category as $item)
                                <a href="{{ route('category.show', $item->id ) }}"><li>{{$item->name}}</li></a>
                            @endforeach
                        </ul>


                    </div>
                   
                </div>

            @endforeach
                
            <div class="cb"></div>
            <h2><a href="#menu">view all menu</a></h2>
            
        </div>
        
        <div class="divider-1">
            <div class="divider-part-1">
                <h1>Glutenfri Retter</h1>
                <h2><a href="#menu">view menu</a></h2>
            </div>
        </div>
        <div class="popular-deals"> 
            <h1>POPULAR DEALS</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

            @foreach($products as $product)
                <a href="{{ route('product.show', $product->id ) }}">
                <div class="deals-part">

                    <div class="home-deal-image">
                      <img  src="{{asset('images/uploads/product/').'/'.$product->thumbnail}}">                  
                    </div>                      

                    <div class="deal-subpart-home">
                        <div class="deal-content-home">
                            <h1>{{$product->name}}</h1> <br/>
                            
                            <p style="text-align:left">{{$product->description}}</p>

                              @foreach($product->Product_Size as $item)
                                    <span>Kr {{ $item->price }}-/ </span>
                                    <?php break; ?>
                              @endforeach

                            <img src="images/deal-cart.png" alt="">
                            <div class="cb"></div>
                        </div>
                    </div>
                </div> 
                </a>           
            @endforeach




            <div class="cb"></div>
            <h2><a href="#menu">view menu</a></h2>
        </div>
        
        <div class="divider-2">
            <div class="divider-part-2">
                <h1>Order your pizza with your choice ingredients</h1>
                <p>Add topping, garlic, cheese etc.</p>
                <h2><a href="{{ route('category.show', 1 ) }}">customized pizza</a></h2>
            </div>
        </div>
    
        @include('layouts.shared.subscribe')    
        @include('layouts.shared.footer')


    </div>
    
</body>
</html>