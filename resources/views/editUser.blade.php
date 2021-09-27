<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit User</h2>
  
    </x-slot>
    <form class="form-inline" action="" method="post" enctype="multipart/form-data">
    @csrf 
    <!-- {{ csrf_field() }} -->
      <h4> Edit  : </h4>
      <input name="id" disabled value="{{$members->id}}">
      <label for="name" class="mr-sm-2">User Name :</label>
      <input type="text" class="form-control mb-2 mr-sm-2" id="" value="{{$members->name}}" name="userName">
      <label for="email" class="mr-sm-2">Email address:</label>
      <input type="email" class="form-control mb-2 mr-sm-2"  value="{{$members->email}}" name="userEmail" >
      <label for="pwd" class="mr-sm-2">Password:</label>
      <input type="password" name="userPassword" class="form-control mb-2 mr-sm-2" value="{{$members->password}}" >
      <div class="form-check mb-2 mr-sm-2">
      <select name="userType" id="">
                  <option selected   value="{{$members->usertype}}">{{$members->usertype}}</option>
          @foreach ($types as $type)
              @if ($type->usertype == $members->usertype){
                  @continue;
              }
                @else{   <option value="{{$type->usertype}}">{{$type->usertype}}</option>}
              @endif
                 
          @endforeach
      </select>
      
      </div>
      <button type="submit" class="btn btn-primary mb-2"> Update </button>
    </form>
    <a href="/mainadmin"><button type="submit" class="btn btn-primary mb-2"> Admin Page </button></a>


    <script>
        $(document).on('click' , '#editUser' , function(e){
          e.preventDefault(); 
          var userData =new FormData($('#updateUser')[0]);
          $.ajax({
            type : 'POST' , 
            enctype :'multipart/form-data',
            url : '/mainadmin', 
            data : {userData},
            processData:false,
            contentType:false,
            cache :false,
            success : function (data ){ 
              if(data.status == true)
                alert(data.msg);
                        },
                    error : function (reject){	
                            }
                        });
          });
        
      </script>

</x-app-layout>