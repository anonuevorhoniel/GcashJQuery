@extends('layout')

@section('content')
<table class="table table-bordered">
    <thead>
      <tr>
        <th scope="row">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Lastname</th>
        <th scope="col">Age</th>
        <th scope="col">Country</th>
        <th colspan="2">Action</th>
        
      </tr>
    </thead>
    <tbody>
        @foreach ($gcash as $item)
        <tr>
            <th id="id"> {{$item->id}}</th>
            <th scope="row">{{$item->name}}</th>
            <td>{{$item->lastname}}</td>
            <td>{{$item->age}}</td>
            <td>{{$item->country}}</td>
            <td><button type="button" class="btn btn-warning edit-btn" id="edit-btn" data-id = "{{$item->id}}" data-name="{{$item->name}}" data-lastname="{{$item->lastname}}" data-age="{{$item->age}}" data-country="{{$item->country}}" data-toggle="modal" data-target="#exampleModalLong">
              Edit
            </button></td>
            <td><button id="del" class="btn btn-danger">Delete</button></td>
          </tr>
        @endforeach
     
    </tbody>
  </table>
 

<!-- Update Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center>
          <form>
            @csrf
                      <div class="form-group">
                        <div class="alert alert-success" id="shw" role="alert" style="display: none;">
                      </div>  
                      <div class="form-group row">
                        <div class="col">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name="name" required id="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="col">
                            <label for="exampleInputPassword1">Lastname</label>
                            <input type="text" name="lastname" value="{{$item->name}}" required id="lastname" class="form-control" id="exampleInputPassword1" placeholder="Lastname">
                        </div>
                    </div>
                    
                      <div class="form-group row">
                        
                      <div class="col-9">
                        <label for="exampleInputPassword1">Country</label>
                        <input type="text" name="country" required id="country" class="form-control" id="exampleInputPassword1" placeholder="Country">
                    </div>
                    <div class="col">
                      <label for="exampleInputPassword1">Age</label>
                      <input type="number" name="age" required id="age" class="form-control" id="exampleInputPassword1" placeholder="Age">
                  </div>
                      </div>
                      
                    
                     
      </form>
    </center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="dela" data-id={{$item->id}} class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
    $('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
//edit modal / edit data
$(".edit-btn").on('click', function () {
  var id = $(this).data('id');
  var name = $(this).data('name');
  var lastname = $(this).data('lastname');
  var age = $(this).data('age');
  var country = $(this).data('country');
  $("#name").val(name);
  $("#lastname").val(lastname);
  $("#age").val(age);
  $("#country").val(country);
});
//delete
    function del() { 
      alert("Do you want to delete?");
     }
 //update
 $("#dela").on('click', function () {
var id = $(".edit-btn").data('id');
var name = $("#name").val();
var lastname = $("#lastname").val();
var age = $("#age").val();  
var country = $("#country").val();

console.log("Data to be sent:", {
        id: id,
        name: name,
        lastname: lastname,
        age: age,
        country: country
    });
    $.ajax({
    type: "PUT",
    url: "/edit/" + id,
    dataType: "json",
    // Include CSRF token in the headers
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: {
        'name' : name,
        'lastname' : lastname,
        'age' : age,
        'country' : country
    },
    success: function (response) {
        console.log(response);
        $('#exampleModalLong').modal('hide');
    }
});
    });

</script>
<style>
table.table-bordered{
    border-color: blue
}
</style>
@endsection