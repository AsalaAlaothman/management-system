<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           '{{ $req->name}}' Request Form '{{$user->name}}' 
        </h2>
  
    </x-slot>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
    
            
            <form action="/partadmin/show/{{$req->id}}"  method="POST" enctype="multipart/form-data">
                @csrf  
            <div class="mb-3">
                <label for="">Request Type :</label>
                <select name="type" id="">
                            <option selected disabled value="{{$req->type}}">{{$req->type}}</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email : </label>
                <input type="email" disabled class="form-control" disabled value="{{$req->email}}" name="email" id="">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Name : </label>
                <input type="text"  disabled class="form-control" value="{{$req->name}}" name="name" id="">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label"> Justifications : </label>
                <input type="text"  disabled class="form-control" name ="justi" value="{{$req->justification}}" id="">
            </div>
        
            <div class="mb-3">
                <input type="text" name="attach" disabled value="{{$req->attach}} "> 
                @php
                $file='files/'.$req->attach;
                @endphp
                <iframe src ="{{ asset($file) }}" width="1000px" height="600px"></iframe>
            </div>
    
            {{-- <div class="input-group mb-3">
            <button style="margin-right: 2px;" class="btn btn-outline-secondary" type="submit" id="">Approved</button>
            </div> --}}
       
       
        <div class="input-group mb-3"> 
            <button style="margin-right: 2px;" class="btn btn-outline-danger" type="submit" id="">Approved</button></a> 
        </div> 
    </form>
 <form action=" {{route('partadmin.reject',$req->id)}} " method="POST"  enctype="multipart/form-data">
    @csrf
    <button  style="margin-right: 2px;" class="btn btn-outline-danger" type="submit" id="">Rejected</button>
    </form>
    </div>

</x-app-layout>