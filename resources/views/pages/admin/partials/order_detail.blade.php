@extends('layouts.shared.master')

@section('title')
    Pizzamix
@endsection

@section('assets')
<style>
    
.ingredients-subpart{
    width:24%;
}

.ingredients-subpart-content-heading{
    text-align:center;
}

.ingredients-subpart-content{
    margin-left: 5%;
    width: 100%;
}

</style>
@endsection 
    
@section('header')


@endsection

@section('body')
    
    <div class="container" style="padding-top: 50px">
        <div class="col-md-5">
             <div class="select-item-ingredients ">
                <div class="item-ingredients-part">
                    <h1>Bill Summary</h1>
                    <table class="table" border="0" >
                      <colgroup>
                        <col style="width:40%">
                        <col style="width:60%">
                      </colgroup>                
                        <tr>
                            <td><p>Name</p></td>
                            <td><p><b>{{ $customer->name }}</b></p></td>
                        </tr>                  
                        <tr>
                            <td><p>Username</p></td>
                            <td><p><b>{{ $customer->username }}</b></p></td>
                        </tr>
                        <tr>
                            <td><p>Total Billed Amoount</p></td>
                            <td><p><b>Kr. {{ $order->total_price }} -/</b></p></td>
                        </tr>  
                        <tr>
                            <td><p>In-Cart Products Count</p></td>
                            <td><p><b>{{ count($products) }}</b></p></td>
                        </tr>                                           
                    </table>
                </div>
            </div>           
        </div>

        <div class="col-md-6">
            <div class="select-item-ingredients">
                <div class="item-ingredients-part">
                    <h1>Billing Details</h1>
                    <table class="table table-striped" border="0">
                      <colgroup>
                        <col style="width:40%">
                        <col style="width:60%">
                      </colgroup>                                  
                        <tr>
                            <td><p>Address 1</p></td>
                            <td><p><b>{{ $customer->address_1 }}</b></p></td>
                        </tr>
                        <tr>
                            <td><p>Address 2</p></td>
                            <td><p><b>{{ $customer->address_2 }}</b></p></td>
                        </tr>
                        <tr>
                            <td><p>Address 3</p></td>
                            <td><p><b>{{ $customer->address_3 }}</b></p></td>
                        </tr>
                        <tr>
                            <td><p>Contact Number</p></td>
                            <td><p><b>{{ $customer->cell_phone }}</b></p></td>
                        </tr>
                        <tr>
                            <td><p>Email</p></td>
                            <td><p><b>{{ $customer->email }}</b></p></td>
                        </tr>                                                            
                    </table>
                </div>
            </div>            
        </div>

        <div class="select-item-ingredients" style="width: 95%">
            <div class="item-ingredients-part">
                <h1>Customization DETAILS</h1>

                @if(count($order_detail_items) == 0)
                    <p>Customer has an empty cart!</p>                        
                @endif

                @foreach($order_detail_items as $key=>$value)

                    <div class="order_detail_product-part1">
                        <div class="order_detail_product">
                            <img class="img-thumbnail" src="{{asset('images/uploads/product/').'/'.$value['product_image']}}">
                        </div>
                    </div>

                    <div class="order_detail_product-part2">
                        <table class="table table-striped tablesorter" border="0" style="text-align: center;">
                          <colgroup>
                            <col style="width:40%">                                
                            <col style="width:30%">
                            <col style="width:20%">                            
                          </colgroup>                               
                          <thead>
                              <tr>
                                <th style="text-align: left"><b>Product Name</b></th> 
                                <th style="text-align: center"><b>Price</b></th>                                 
                                <th style="text-align: center"><b>Quantity</b></th>          
                              </tr>
                          </thead>

                           <tbody>
                                <tr>
                                    <td style="text-align: left">{{ $value['product_name'] }}</td>
                                    <td>{{ $value['product_price'] }}</td>
                                    <td>{{ $value['quantity'] }}</td>                                    
                                </tr>                            
                            </tbody>
                        </table>                        
                    </div>

                    <div class="cb"></div>
                    <br>

                <div class="ingredients-subpart">
                    <div class="ingredients-info header-info">
                        <div class="ingredients-subpart-content">
                            <p class="ingredients-subpart-content-heading">Accessories</p>
                        </div>
                    </div>

                    @if( array_key_exists('accessory', $value) != null )
                        @foreach($value['accessory'] as $item=>$item_value)

                            <div class="ingredients-info">
                                <div id="div_accessories" style="text-align: center" class="ingredients-subpart-content">
                                       {{$item_value['item_name']}}   
                                </div>
                            </div>

                        @endforeach
                    @else 

                        <div class="ingredients-info">
                            <div class="ingredients-subpart-content">
                                <p style="text-align: center"> No listed accessories </p>
                                <div class="cb"></div>
                            </div>
                        </div>
                    @endif


                </div>
                
                
                <div class="ingredients-subpart">
                    <div class="ingredients-info header-info">
                        <div class="ingredients-subpart-content">
                            <p class="ingredients-subpart-content-heading">INGREDIENTS</p>
                        </div>
                    </div>

                    @if( array_key_exists('ingredient', $value) != null )
                        @foreach($value['ingredient'] as $item=>$item_value)

                        <div class="ingredients-info">
                            <div id="div_ingredients" style="text-align: center" class="ingredients-subpart-content">
                                {{$item_value['item_name']}}   
                            </div>
                        </div>

                        @endforeach

                    @else 

                        <div class="ingredients-info">
                            <div class="ingredients-subpart-content">       
                                <p style="text-align: center"> No listed ingredients </p>
                                <div class="cb"></div>
                            </div>
                        </div>
                    @endif                  

                </div>

                <div class="ingredients-subpart">
                    <div class="ingredients-info header-info">
                        <div class="ingredients-subpart-content">
                            <p class="ingredients-subpart-content-heading">ADDITIONAL OPTIONS</p>
                        </div>
                    </div>

                    @if( array_key_exists('sidedish', $value) != null )
                        @foreach($value['sidedish'] as $item=>$item_value)

                        <div class="ingredients-info">
                            <div id="div_customOrders" style="text-align: center" class="ingredients-subpart-content">
                                {{$item_value['item_name']}}     
                            </div>
                        </div>

                        @endforeach
                    @else 

                        <div class="ingredients-info">
                            <div class="ingredients-subpart-content">
                                <p style="text-align: center"> No listed side dishes </p>
                                <div class="cb"></div>
                            </div>
                        </div>
                    @endif


                </div>

                <div class="ingredients-subpart">
                    <div class="ingredients-info header-info">
                        <div class="ingredients-subpart-content">
                            <p class="ingredients-subpart-content-heading">Default Serving</p>
                        </div>
                    </div>

                    @if( array_key_exists('default', $value) != null )
                        @foreach($value['default'] as $item=>$item_value)

                        <div class="ingredients-info">
                            <div id="div_defaults" style="text-align: center" class="ingredients-subpart-content">
                                {{$item_value['item_name']}}
                            </div>
                        </div>

                        @endforeach
                    @else 

                        <div class="ingredients-info">
                            <div class="ingredients-subpart-content">
                                <p style="text-align: center"> No listed side dishes </p>
                                <div class="cb"></div>
                            </div>
                        </div>
                    @endif


                </div>

                <div class="cb" style="padding-bottom: 30px;"></div>

                @endforeach
                                                
            </div>
            
            

            
            <div class="cb"></div>

        </div>

    </div>


@endsection

@section('footer')

@endsection
