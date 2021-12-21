@extends('adminlte::page')

@section('title', 'User Management')

@section('content_header')
    <h1 class="m-0 text-dark">User Management</h1>
@stop

@section('content')
<div class="card card-info">
    @if (session('error'))
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                {{ session('error') }}
            @endforeach
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
        <h3 class="card-title">User Management Create</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form id="user_manage_create" class="form-horizontal" method="POST" action="{{ route('admin.create_user_save') }}">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" value="" name="name" id="name" class="form-control"   placeholder="Name">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email"  value="" name="email" id="email" class="form-control"   placeholder="Email">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password"  value="" name="password" id="password" class="form-control"   placeholder="Password">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Role</label>
                <div class="col-sm-10">
                    <select class="selectpicker1 form-control col-sm-12" id="role_id" multiple data-live-search="true" name="role_id[]">
                        <?php foreach($role as $key=>$val){ ?>
                            <option value="{{ $val->id}}">{{ $val->name}}</option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            
            
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
            <button type="submit" class="btn btn-info">Save</button>
            <a href="{{ route('admin.user_management') }}"><button type="button" class="btn btn-default float-right">Cancel</button><a>
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
      
    $(document).ready(function() {
        $('.selectpicker1').select2();
   });
   </script>
   
<script>
    setTimeout(function() {
              $(".alert").alert('close');
            }, 5000);
    
    
    </script>
      <script>
        // var id = $('#id').val();

   
 $(document).ready(function() {
  $("#user_manage_create").validate({
    rules: {
        name: {
            required: true,
        },
        email: {
            required: true,
            email: true,
            remote: {
                url: "{{ route('admin.user_create_emailveify')}}",
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}",
                    // "id": id
                }
            },
        },
        password: {
            required: true,
            minlength: 8
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
        password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 8 characters long"
        },
    },
   
    submitHandler: function(form) {
      form.submit();
    }
  });
});
 

    </script>
@stop