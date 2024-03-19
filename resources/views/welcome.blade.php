@extends('layout')

@section('content')
<center>
    <form>
        <div class="row" style="margin-left: 25%">
            <div class="card text-white bg-secondary mb-3" style="width: 20%; margin-top: 2%">
                <div class="card-body">
                    
                </div>
            </div>
            <div class="card text-white bg-dark mb-3" style="width: 40%; margin-top: 2%">
                <div class="card-body">
                    <div class="form-group">
                      <div class="alert alert-success" id="shw" role="alert" style="display: none;">
                    </div>  
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" name="name" required id="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Lastname</label>
                        <input type="text" name="lastname" required id="lastname" class="form-control" id="exampleInputPassword1" placeholder="Lastname">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Age</label>
                        <input type="number" name="age" required id="age" class="form-control" id="exampleInputPassword1" placeholder="Age">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Country</label>
                        <input type="text" name="country" required id="country" class="form-control" id="exampleInputPassword1" placeholder="Country">
                    </div>
                    <button class="btn btn-success" style="width: 65%">Submit</button>
                </div>
            </div>
        </div>
    </form>
</center>

<script>
    $(function () {
        $("form").submit(function (event) {
            event.preventDefault();
            $("#shw").hide(); 
            var values = {
                '_token': $('meta[name="csrf-token"]').attr('content'), 
                'name': $("#name").val(),
                'lastname': $("#lastname").val(),
                'age': $("#age").val(),
                'country': $("#country").val()
            };
            $.ajax({
                type: "POST",
                url: "/submit",
                data: values,
                dataType: "json",
                success: function(response) {
                    $("#name").val(" ");
                    $("#lastname").val(" ");
                    $("#age").val(" ");
                    $("#country").val(" ");
                    $("#shw").html(response.message);
                    $("#shw").show(); // Show the success message div
                   
               
                    setTimeout(function() {
                        $("#shw").hide();
                }, 3000);
                }
            });
        });
    });
</script>

@endsection
