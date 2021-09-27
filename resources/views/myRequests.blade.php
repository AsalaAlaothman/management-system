<x-app-layout>

  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         My Requests
      </h2>

  </x-slot>
{{-- <h3>{{$Page_Name}}</h3> --}}
<div>
    {{-- {{$Sellection}} --}}

        <table class="table table-striped table-dark">
          <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Request Title </th>
                <th scope="col">Date</th>
                <th scope="col">Request type</th>
                <th scope="col">Accountant</th>
                <th scope="col">HR</th>
                <th scope="col">Mangement</th>  
                <th scope="col">Request's Status</th>          
            </tr>
          </thead>

          <tbody>
            @foreach ($reqs as $req)
                      <tr>
                        <th>{{$req->id}}</th>
                        <th>{{$req->name}}</th>
                        <th>{{$req->updated_at}}</th>
                        <th>{{$req->type}}</th>
                        <th>@if($req->Accountant =='None') ___
                            @elseif($req->Accountant =='Active') <button disabled type="button" style = "color:rgb(60, 233, 60)" class="btn btn-info">Active</button> 
                            @elseif($req->Accountant =='Approved')<button disabled type="button" style = "color:rgb(48, 48, 194)" class="btn btn-success">Approved</button>
                            @elseif($req->Accountant =='Rejected')<button disabled type="button" style = "color:red" class="btn btn-danger">Rejected</button>

                            @endif</th>
                        <th>@if($req->hr =='None') ___
                          @elseif($req->Accountant == 'Active')<button disabled type="button" class="btn btn-info">Next Step</button> 
                          @elseif($req->hr =='Active') <button disabled type="button" style = "color:rgb(60, 233, 60)"   class="btn btn-info">Active</button> 
                          @elseif($req->hr =='Approved') <button disabled type="button" style = "color:rgb(48, 48, 194)" class="btn btn-success">Approved</button> 
                          @elseif($req->hr =='Rejected')<button disabled type="button" style = "color:red" class="btn btn-danger">Rejected</button>
                          @endif</th>
                        <th>
                          @if($req->hr == 'Active')<button disabled type="button" class="btn btn-info">Next Step</button> 
                          @elseif($req->Management =='Active') <button disabled type="button" style = "color:rgb(60, 233, 60)" class="btn btn-info">Active</button> 
                          @elseif($req->Accountant =='Active')<button disabled type="button" class="btn btn-danger">Not Started</button>
                          @elseif($req->Management =='Approved') <button disabled type="button" style = "color:rgb(48, 48, 194)" class="btn btn-success">Approved</button> 
                          @elseif($req->Management =='Rejected')<button disabled type="button" style = "color:red" class="btn btn-danger">Rejected</button>
                          @endif</th>
                         
                        <th>{{$req->status}}</th>
                       <th> @if($req->status =='pending' || $req->status =='draft' )
                        
                        <a href={{'/request/'.$req->id}} > <button style="margin-right: 2px;" class="btn btn-outline-secondary" type="submit" id="">Show</button></a>
                        
                        @endif</th>
                      </tr>
            @endforeach 
            
          </tbody>
        </table>
   
      <div>
      </div>
    </form>

</div>
</x-app-layout>

 
 