
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
                        <th {{ $formating_th }} >Approval Time</th>                                    
                        <th {{ $formating_th }} >Delivery Time</th>
                        <th {{ $formating_th }} >Status</th>                        
                        <th {{ $formating_th }} >Actions</th>
                      </tr>
                  </thead>

                   <tbody>

                  <!-- check if requests exsists -->
                  @if(count($orders->$key->get()) != 0) 

                    @foreach($orders->$key->get() as $req)                

                        @if( $req->status != 7 )

                            <tr>
                                <td {{ $formating_td }}><a href="{{ route('order.show', $req->id ) }}"><p>{{$req->id}}</p></a></td>
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

                                    <?php $status = $req->status; ?>

                                    @if($status == 0)
                                      Pending Acknowledgment

                                    @elseif($status == 1)
                                      Acknowledged

                                    @elseif($status == 2)
                                      Approved

                                    @elseif($status == 3)
                                      Dispatched

                                    @elseif($status == 4)
                                      Delivered

                                    @elseif($status == 5)
                                      Disapproved

                                    @elseif($status == 6)
                                      Cancelled

                                    @endif
                                </td>                             
                                <td {{ $formating_td }}>

                                    @if($status <= 3)
                                        <button type="button" value="{{$req->id}}"class="btnCancel btn btn-danger btn-xs"> 
                                            Cancel
                                       </button> 
                                        <button type="button" value="{{$req->id}}"class="btnArchive btn btn-primary btn-xs"> 
                                            Archive
                                       </button> 

                                    @else
                                        <button type="button" disabled value="{{$req->id}}"class="btnCancel btn btn-danger btn-xs"> 
                                            Cancel
                                       </button> 
                                        <button type="button" value="{{$req->id}}"class="btnArchive btn btn-primary btn-xs"> 
                                            Archive
                                       </button>                                     

                                    @endif

                                </td>                          
                            </tr>                                                  
                        @endif
            
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
