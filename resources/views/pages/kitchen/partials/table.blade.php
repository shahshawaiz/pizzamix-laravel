
  <!-- ////////////////////////////////// Pending Acnkowldgments /////////////////////////// -->               
  <div class="content" id="div_acknowledged">

      <!-- list of keys in order controller -->

      @foreach($orders as $key=>$value)

          <table class="table table-striped tablesorter" border="0">
                  
                  <!-- styling for rows -->
                  <?php $formating_th = 'width=20% style=text-align:center'; ?>
                  <?php $formating_td = 'width=20% style=text-align:center'; ?>                  

                  <thead>
                      <tr>
                        <th {{ $formating_th }} >Order ID</th>
                        <th {{ $formating_th }} >Customer ID</th>     
                        <th {{ $formating_th }} >Approval Time</th>                                    
                        <th {{ $formating_th }} >Delivery Time</th>            
                        <th {{ $formating_th }} >Actions</th>
                      </tr>
                  </thead>

                   <tbody>

                  <!-- check if requests exsists -->
                  @if(count($orders->$key->get()) != 0)

                    @foreach($orders->$key->get() as $req)                

                        <tr>
                            <td {{ $formating_td }}><a href="{{ route('order.show', $req->id ) }}"><p>{{$req->id}}</p></a></td>
                            <td {{ $formating_td }}>{{$req->user_id}}</td>
                            <td {{ $formating_td }}>
                              @if( $req->approval_time == null )
                                <p>N/A</p>
                              @else
                                $req->approval_time
                              @endif                                  
                            </td>
                            <td {{ $formating_td }}>
                              @if( $req->delivery_time == null )
                                <p>N/A</p>
                              @else
                                $req->delivery_time
                              @endif
                            </td> 
                   
                            <td {{ $formating_td }}>
                                    <button type="button" value="{{$req->id}}"class="btnDispatch btn btn-success btn-xs"> 
                                        Dispatch for delivery
                                   </button>  
                            </td>                          
                        </tr>                                                  
            
                    @endforeach  

                  <!-- no requests message -->
                  @else
                        <tr>
                            <td colspan="5" {{ $formating_td }}><p>No requests found!</p></td>
                        </tr>                 
                  @endif  
                  
                  </tbody>                                   
          </table>           


      @endforeach


  </div>           

  <!-- ////////////////////////////////// Pending Acnkowldgments /////////////////////////// -->
