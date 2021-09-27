<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin</h2>
  
    </x-slot>
<form class="form-inline" action="/mainadmin"  method="POST" enctype="multipart/form-data">
  @csrf 
  <!-- {{ csrf_field() }} -->
    <h4> Add a New Employee : </h4>
    <label for="name" class="mr-sm-2">User Name :</label>
    <input type="text" class="form-control mb-2 mr-sm-2" id="" name="userName">
    <label for="email" class="mr-sm-2">Email address:</label>
    <input type="email" class="form-control mb-2 mr-sm-2" placeholder="Enter email" name="userEmail" id="email">
    <label for="pwd" class="mr-sm-2">Password:</label>
    <input type="password" name="userPassword" class="form-control mb-2 mr-sm-2" placeholder="Enter password" id="pwd">
    <div class="form-check mb-2 mr-sm-2">
    <select name="userType" id="">
        @foreach ($types as $type)
                <option value="{{$type->usertype}}">{{$type->usertype}}</option>
        @endforeach
    </select>
    
    </div>
    <button id="addUser" type="submit" class="btn btn-primary mb-2">Submit</button>
  </form>


<br><br><br>
<hr>
  <div class="col-md-8">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Job Title</th>
            <th>Craete at</th>
            <th>Update at</th>
          </tr>
        </thead>

        <tbody>
        @foreach ($members as $member)
          <tr>
            <th>{{$member->id}}</th>
            <th>{{$member->name}}</th>
            <th>{{$member->email}}</th>
            <th>
              <select  id="">
                    <option name="type"  selected value="{{$member->usertype}}">{{$member->usertype}}</option>

                    {{-- @foreach ($userts as $usert)
                            @if( $usert->usertype == $member->usertype ){
                              @continue;
                            }
                            @else{
                               <option value="{{$usert->usertype}}">{{$usert->usertype}}</option>
                            }  
                            @endif 
                           
                   @endforeach  --}}
              </select>
            </th>
            <th>{{$member->created_at}}</th>
            <th>{{$member->updated_at}}</th>
            <th> <a href={{'/mainadmin/editUser/'.$member->id}} > <button style="margin-right: 2px;" class="btn btn-outline-secondary" type="submit" id="">Show</button></a>
              <form action=" {{route('admin.delete',$member->id)}} " method="POST"  enctype="multipart/form-data">
                @csrf
                  <button style="margin-right: 2px;" class="btn btn-outline-danger" type="submit" id="">Remove</button>
                </form></th>
           
          </tr>
        @endforeach 
        </tbody>
    </div> 
    <div>
    </div>
</x-app-layout>
