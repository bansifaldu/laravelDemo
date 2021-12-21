@extends('adminlte::page')

@section('title', 'Profile Update')

@section('content_header')
    <h1 class="m-0 text-dark">User Profile</h1>
@stop

@section('content')
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Profile Update</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form id= "user_setting" class="form-horizontal" method="POST" action="/admin/user_setting_save">
        @csrf
        <input type="hidden" value="{{$user->id}}" name="id" id="id" class="form-control"    >

        <div class="card-body">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" value="{{ $user->name }}" name="name" id="name" class="form-control" id="name" placeholder="Name">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email"  value="{{ $user->email }}" name="email" id="email" class="form-control" id="inputEmail3" placeholder="Email">
                </div>
            </div>
            
            
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
            <button type="submit" class="btn btn-info">Update</button>
            <a href="{{ route('home') }}"><button type="button" class="btn btn-default float-right">Cancel</button><a>
       </div>
      <!-- /.card-footer -->
    </form>
  </div>
  <!-- /.card -->

</div>
     
@stop
@section("footer")
Ritesh Khatri
@stop
@section('js')
<script>
    setTimeout(function() {
              $(".alert").alert('close');
            }, 5000);
    
    
    </script>
    <script>
        var id = $('#id').val();

   
 $(document).ready(function() {
  $("#user_setting").validate({
    rules: {
      name: {
        required: true,
       },
      email: {
        required: true,
        email: true,
        remote: {
            url: "{{ route('admin.varifyemail')}}",
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id
            }
        },
      },
    },
    // Specify validation error messages
    messages: {
        name: {
            required: "Please provide a name",
        },
        email: {
            required: "Please provide a email",
            email: "Please enter a valid email address",
            remote : "Please enter unique email address",
        },
    },
   
    submitHandler: function(form) {
      form.submit();
    }
  });
});
 

    </script>
@stop