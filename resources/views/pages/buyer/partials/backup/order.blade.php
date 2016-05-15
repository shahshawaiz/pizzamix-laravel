
  <!-- ////////////////////////////////// Pending Acnkowldgments /////////////////////////// -->               
  <div class="content">

      <h4>Order requests</h4>

      <table class="table table-striped tablesorter">

              <thead>
                  <tr>
                    <th width="10%">Order ID</th>
                    <th width="10%">Customer ID</th>     
                    <th width="10%">Approval Time</th>                                    
                    <th width="10%">Delivery Time</th>
                    <th width="10%">Status</th>

                  </tr>
              </thead>

               <tbody>
               
              @foreach($orders->get() as $req)                
                  <tr>
                      <td width="10%"><p>{{$req->Order_status->order_id}}</p></td>
                      <td width="10%">1</td>
                      <td width="10%">
                        @if( $req->Order_status->approval_time == null )
                          N/A
                        @else
                          $req->Order_status->approval_time
                        @endif                                  
                      </td>
                      <td width="10%">
                        @if( $req->Order_status->delivery_time == null )
                          N/A
                        @else
                          $req->Order_status->delivery_time
                        @endif
                      </td> 
                      <td width="10%">
                        {{ $req->Order_status->status }}
                      </td>                          
                  </tr>                                      
              @endforeach     

                                  
              </tbody>                                   
      </table>                            
  </div>           

  <!-- ////////////////////////////////// Pending Acnkowldgments /////////////////////////// -->
