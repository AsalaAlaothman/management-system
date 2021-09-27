<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           The Request
        </h2>
  
    </x-slot>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

        
        <form action="" method="post" enctype="multipart/form-data">
            @csrf <!-- {{ csrf_field() }} -->
        <div class="mb-3">
            <label for="">Request Type :</label>
            <select name="type" id="">
                        <option selected value="{{$req->type}}">{{$req->type}}</option>
                        @foreach ($Types as $Type)
                            @if ($Type->requesttype == $req->type){
                                @continue;
                                }
                            @else{
                                <option  value="{{$Type->requesttype}}">{{$Type->requesttype}}</option>
                            }
                                
                            @endif
                        @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email : </label>
            <input type="email" class="form-control" disabled value="{{$req->email}}" name="email" id="">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Request Title : </label>
            <input type="text" class="form-control" value="{{$req->name}}" name="name" id="">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label"> Justifications : </label>
            <input type="text" class="form-control" name ="justi" value="{{$req->justification}}" id="">
        </div>
    
        <div class="mb-3">
            <input type="text" name="attach" disabled value="{{$req->attach}}">
            <input name="attachment"  type="file">
        </div>
        <div class="mb-3">
            @php
            $file='files/'.$req->attach;
            @endphp
            {{-- <a href="{{asset($file)}}">Open the pdf!</a> - --}}
            <iframe src ="{{ asset($file) }}" width="1000px" height="600px"></iframe>
        </div>
        
        <div class="input-group mb-3">
           
                <button style="margin-right: 2px;" class="btn btn-outline-secondary" type="submit" id="">Update</button> 
            
        </div>
           
    </form>      
    </div>
    </div>
</div>
</x-app-layout>
