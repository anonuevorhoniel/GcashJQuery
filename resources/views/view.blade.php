@extends('layout')

@section('content')
    
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Lastname</th>
      <th scope="col">Age</th>
      <th scope="col">Country</th>
      <th colspan="2">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($gcash as $item)
    <tr id="row_{{$item->id}}">
      <th scope="row">{{$item->id}}</th>
      <td class="name">{{$item->name}}</td>
      <td class="lastname">{{$item->lastname}}</td>
      <td class="age">{{$item->age}}</td>
      <td class="country">{{$item->country}}</td>
    <!-- step 1 declare muna yung data sa buttons -->  <td><button class="btn btn-warning edit-btn" 
      data-id = "{{$item->id}}"
      data-name = "{{$item->name}}"
      data-lastname = "{{$item->lastname}}"
      data-age = "{{$item->age}}"
      data-country = "{{$item->country}}"      
      data-toggle="modal" data-target="#exampleModal">Edit</button></td>
      <td><button class="btn btn-danger delete" id="delete" data-id="{{$item->id}}">Delete</button></td>
    </tr>
    @endforeach
   
  </tbody>
</table>


<!-- Modal -->
<div class="modal fade modalz" id="exampleModal" data-id="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          @csrf
          <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" id="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Lastname</label>
            <input type="text" id="lastname" class="form-control" id="exampleInputPassword1" placeholder="Password">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Age</label>
            <input type="text" id="age" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Country</label>
            <input type="text" id="country" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save-btn" data-dismiss="modal">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script>
  $(function()
  {
    var varias;
    $(".edit-btn").on("click", function () {
      //step 2: kunin yung laman na data ng button
      varias = $(this).data("id");
    var name = $(this).data("name");
    var lastname = $(this).data("lastname");
    var age = $(this).data("age");
    var country = $(this).data("country");
      var datat = [varias, name, lastname, age, country];
    var mod = $(".modalz").data("id", varias);
    console.log(mod);
  
//step 3: paltan ang value ng button
    $("#name").val(name);
    $("#lastname").val(lastname);
    $("#age").val(age);
    $("#country").val(country);

    });
    $("#save-btn").on("click", function () {
var id = varias;
 name = $("#name").val();
 lastname = $("#lastname").val();
 age = $("#age").val();
 country = $("#country").val();

 $.ajax({
  type: "PUT",
  url: "/edit/" + id,
  data: {
    'name' : name,
    'lastname' : lastname,
    'age' : age,
    'country' : country
  },
  dataType: "json",
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
  success: function (response) {
    console.log(response);
    $("#row_" + id + " .name").text(name);
    $("#row_" + id + " .lastname").text(lastname);
    $("#row_" + id + " .age").text(age);
    $("#row_" + id + " .country").text(country);

  }
  
 });

    });

    $(".delete").on('click', function () {
      if(confirm('Do you want to delete this?'))
      {
        id = $(this).data('id');
    
        $.ajax({
          type: "delete",
          url: "/delete/" + id,
          headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
          success: function (response) {
            $('#row_' + id).remove();
            console.log('Removed ' + id);
          }
        });

      }
      else{

      }
    
    });
  })
</script>


@endsection