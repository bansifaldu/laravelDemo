@extends('adminlte::page')

@section('title', 'Change Password')

@section('content_header')
    <h1 class="m-0 text-dark">User Profile</h1>
@stop

@section('content')
<div class="card card-info">
    @if (session('error'))
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
                {{ session('error') }}
         </ul>
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="card-header">
        <h3 class="card-title">Change Password</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
   
    <form id="change_pass" class="form-horizontal" method="POST" action="/admin/change_password_save">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <label for="current_password" class="col-sm-2 col-form-label">Current password</label>
                <div class="col-sm-10">
                    <input type="password" value="" name="current_password" id="current_password" class="form-control"  placeholder="Password">
                </div>
            </div>
            <div class="form-group row">
                <label for="new_password" class="col-sm-2 col-form-label">New password</label>
                <div class="col-sm-10">
                    <input type="password" value="" name="new_password" id="new_password" class="form-control"   placeholder="New password">
                </div>
            </div>
            <div class="form-group row">
                <label for="new_password_confirmation" class="col-sm-2 col-form-label">Confirm password</label>
                <div class="col-sm-10">
                    <input type="password" value="" name="new_password_confirmation" id="new_password_confirmation" class="form-control"  placeholder="Confirm password">
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
        // var id = $('#id').val();

   
                $(document).ready(function() {
                $("#change_pass").validate({
                    rules: {
                        current_password: {
                            required: true,
                            minlength: 8
                        },
                        new_password: {
                            required: true,
                            minlength: 8
                        },
                        new_password_confirmation: {
                            required: true,
                            equalTo : "#new_password"
                        },
                    },
                    // Specify validation error messages
                    messages: {
                        password: {
                            required: "Please provide a password",
                            minlength: "Your password must be at least 8 characters long"
                        },
                        new_password: {
                            required: "Please provide a new password",
                            minlength: "Your new password must be at least 8 characters long"
                        },
                        new_password_confirmation: {
                            required: "Please provide a confirmation password",
                            equalTo: "Your confirm password must be same as new password"
                        },
                    },
                
                    submitHandler: function(form) {
                    form.submit();
                    }
                });
                });
 

    </script>
@stop