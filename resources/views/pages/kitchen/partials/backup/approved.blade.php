            <!-- ////////////////////////////////// Acnkowldgmed /////////////////////////// -->               
            <div class="content">

                <h4>Approved</h4>
    
                <table class="table table-striped tablesorter">

                        <thead>
                            <tr>
                              <th width="10%">Order ID</th>
                              <th width="10%">Customer ID</th>     
                              <th width="10%">Approval Time</th>                                    
                              <th width="10%">Delivery Time</th>
                              <th></th>

                            </tr>
                        </thead>

                         <tbody>
                        @foreach($orders->approved->get() as $req)                
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
                                  <button type="button" value="{{$req->id}}"class="btnUpdateStatus btn btn-success btn-xs">  
                                    Dispatch
                                  </button>                                                                                   
                                </td>                          
                            </tr>                                      
                        @endforeach                         
                        </tbody>                                   
                </table>                            
            </div>
            
            <!-- ////////////////////////////////// Acnkowldgmed /////////////////////////// -->
