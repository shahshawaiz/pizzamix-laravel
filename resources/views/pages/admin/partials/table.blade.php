
  <!-- ////////////////////////////////// Pending Acnkowldgments /////////////////////////// -->               
  
      <!-- list of keys in order controller -->

      @foreach($orders as $key=>$value)
      <div class="content">
    
          <h4>

            @if($key == 'pending_acknowledgments')
              Pending Acknowledgment

            @elseif($key == 'acknowledged')
              Acknowledged

            @elseif($key == 'approved')
              Approved

            @elseif($key == 'dispatched')
              Dispatched

            @elseif($key == 'delivered')
              Delivered

            @elseif($key == 'disapproved')
              Disapproved

            @elseif($key == 'cancelled')
              Cancelled

            @endif

            <small class="{{$key}}_visiblity show. text-muted" style="float:right; cursor: pointer;">Hide</small>

          </h4>

          <div class="{{$key}}">

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
                                <td {{ $formating_td }}><a href="{{ route('order.show', $req->order_id ) }}"><p>{{$req->id}}</p></a></td>
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

                                    @if($key == 'pending_acknowledgments')
                                        <button type="button" value="{{$req->id}}"class="btnAcknowledge btn btn-warning btn-xs"> 
                                            Acknowledge
                                       </button>  

                                    @elseif($key == 'acknowledged')
                                        <button type="button" value="{{$req->id}}"class="btnApprove btn btn-success btn-xs"> 
                                            Approve
                                       </button>  
                                       <button type="button" value="{{$req->id}}"class="btnDisapprove btn btn-danger btn-xs"> 
                                            Disapprove
                                        </button>                                                 

                                    @elseif($key == 'approved')
                                        <button type="button" value="{{$req->id}}"class="btnDispatch btn btn-success btn-xs"> 
                                            Dispatch
                                       </button>  
                                       <button type="button" value="{{$req->id}}"class="btnCancel btn btn-danger btn-xs"> 
                                            Cancelled
                                        </button> 

                                    @elseif($key == 'dispatched')
                                        <button type="button" value="{{$req->id}}"class="btnDeliverd btn btn-success btn-xs"> 
                                            Deilver
                                       </button>  
                                       <button type="button" value="{{$req->id}}"class="btnCancel btn btn-danger btn-xs"> 
                                            Cancelled
                                        </button>

                                    @elseif($key == 'delivered')
                                        <button type="button" value="{{$req->id}}"class="btnArchive btn btn-primary btn-xs"> 
                                            Archive
                                       </button>  

                                    @elseif($key == 'disapproved')
                                        <button type="button" value="{{$req->id}}"class="btnArchive btn btn-primary btn-xs"> 
                                            Archive
                                       </button>  

                                    @elseif($key == 'cancelled')
                                        <button type="button" value="{{$req->id}}"class="btnArchive btn btn-primary btn-xs"> 
                                            Archive
                                       </button>  

                                    @endif

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
            
            </div>

      </div>     

      @endforeach

  <!-- ////////////////////////////////// Pending Acnkowldgments /////////////////////////// -->
