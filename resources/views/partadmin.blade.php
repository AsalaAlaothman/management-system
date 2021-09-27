<x-app-layout>

    <x-slot name="header">
       
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{$admin->usertype}} Requests </h2>
        
      
  
    </x-slot>

    <div>
        {{-- {{$Sellection}} --}}
    
            <table class="table table-striped table-dark">
              <thead>
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Name</th>
                  <th scope="col">Type</th>
                  <th scope="col">Justification</th>
                  <th scope="col">Attachment</th>
                  @if($admin->usertype == 'HR')
                                <th scope="col">Accountant</th>
                  @elseif($admin->usertype == 'Management')
                            <th scope="col">Accountant</th>
                            <th scope="col">HR</th>
                  @endif
                  <th scope="col">Craete at</th>
                  <th scope="col">Update at</th>
    
                  
                </tr>
              </thead>
             
           
                    
                
              <tbody>
                
                
                  @foreach($accapp as $acc)
                      
                        @if($acc->updated_at >= $admin->updated_at ) 
                          <tr>
                            <th>{{$acc->id}}</th>
                            <th>{{$acc->name}}</th>
                            <th>{{$acc->type}}</th>
                            <th>{{$acc->justification}}</th>
                            <th>{{$acc->attach}}</th>
                           
                            @if($admin->usertype == 'HR')
                            <th>
                              @if($acc->Accountant == 'None')
                                __ 
                              @elseif($acc->Accountant == 'Approved')
                                <button type="button" disabled class="btn btn-success">Approved</button> 
                              @endif</th>
                                {{-- <th>{{$acc->Accountant}}</th> --}}
                            @elseif($admin->usertype == 'Management')
                              <th>@if($acc->Accountant == 'None')
                                __ 
                              @elseif($acc->Accountant == 'Approved')
                              <button type="button" disabled class="btn btn-success">Approved</button> 
                              @endif</th>
                              <th>@if($acc->hr == 'None')
                                __ 
                              @elseif($acc->hr == 'Approved')
                              <button type="button" disabled class="btn btn-success">Approved</button> 
                              @endif</th>
                            @endif
                            <th>{{$acc->created_at}}</th>
                            <th>{{$acc->updated_at}}</th>
                            <th> <a href={{'/partadmin/show/'.$acc->id}} > <button style="margin-right: 2px;" class="btn btn-outline-secondary" type="submit" id="">Show</button></a>
                            </th>
                          </tr>
                      
                    @endif
                
      
                @endforeach 
                
              </tbody>
            </table>
       
          <div>
          </div>
        </form>
    
    </div>


</x-app-layout>