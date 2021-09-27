<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Apply a request 
        </h2>

    </x-slot>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

        
        <form action='' id ="addrequest" method="post" enctype="multipart/form-data">
            @csrf <!-- {{ csrf_field() }} -->
        <div class="mb-3">
            {{-- <input type="number" name="id" value="{{}}" hidden> --}}
            <label for="">Request Type :</label>
            <select name="type" id="">
                @foreach ($Types as $Type)
                        <option value="{{$Type->requesttype}}">{{$Type->requesttype}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Request Title : </label>
            <input type="text" class="form-control" name="name" id="">
        </div>
        {{-- <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email : </label>
            <input type="email" class="form-control" name="email" id="">
        </div> --}}
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label"> Justifications : </label>
            <input type="text" class="form-control" name ="justi" id="">
        </div>
    
        <div class="mb-3">
            <input name="attach" accept=".pdf,.docs"  type="file">
        </div>
        <div class="input-group mb-3">
            <button style="margin-right: 2px;" class="btn btn-outline-secondary" id="requestNew">Submit</button> 
        </div>
           
    </form>
    <br>
    <hr>
    <br>
    <a href="/myRequests/{email}"><button>My requests</button></a>


          
        </div>
    </div>
</div>



<script>
    $(document).on('click', '#requestNew' , function(e){
      e.preventDefault(); 
      var formData =new FormData($('#addrequest')[0]);
      $.ajax({
        type : 'POST' , 
        enctype :'multipart/form-data',
        url : '/request', 
        data : formData,
        processData:false,
				contentType:false,
			 	cache :false,
        success : function (data ){ 
          if(data.status == true){
            alert(data.msg)}
					},
				error : function (reject){	
						}
					});
      });
    
  </script>
</x-app-layout>
