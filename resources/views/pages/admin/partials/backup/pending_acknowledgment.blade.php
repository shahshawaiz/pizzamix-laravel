
  <!-- ////////////////////////////////// Pending Acnkowldgments /////////////////////////// -->               
  <div class="content">

      <h4>Pending Acknowledgements</h4>

      <table class="table table-striped tablesorter">

              <thead>
                  <tr>
                    <th width="20%">Order ID</th>
                    <th width="20%">Customer ID</th>     
                    <th width="20%">Approval Time</th>                                    
                    <th width="20%">Delivery Time</th>
                    <th width="20%"></th>
                  </tr>
              </thead>

               <tbody>
               
              @foreach($orders->pending_acknowledgments->get() as $req)                
                  <tr>
                      <td width="10%"><p>{{$req->order_id}}</p></td>
                      <td width="10%">1</td>
                      <td width="10%">
                        @if( $req->approval_time == null )
                          N/A
                        @else
                          $req->approval_time
                        @endif                                  
                      </td>
                      <td width="10%">
                        @if( $req->delivery_time == null )
                          N/A
                        @else
                          $req->delivery_time
                        @endif
                      </td> 
                      <td width="10%">
                        <button type="button" value="{{$req->id}}"class="btnUpdateStatus btn btn-warning btn-xs">Acnknowledge
                        </button>
                      </td>                          
                  </tr>                                      
              @endforeach                         
              </tbody>                                   
      </table>                            
  </div>           

  <!-- ////////////////////////////////// Pending Acnkowldgments /////////////////////////// -->
