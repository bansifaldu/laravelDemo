@extends('adminlte::page')

@section('title', 'Permission Management')

@section('content_header')
    <h1 class="m-0 text-dark">Permission Management</h1>
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
        <h3 class="card-title">Permission Create</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form id="permission_create" class="form-horizontal" method="POST" action="{{ route('permission.create_permission_save') }}">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" value="" name="name" id="name" class="form-control"   placeholder="Name">
                </div>
            </div>
            <div class="form-group row">
                <label for="slug" class="col-sm-2 col-form-label">Slug</label>
                <div class="col-sm-10">
                    <input type="text" value="" name="slug" id="slug" class="form-control"   placeholder="Slug">
                </div>
            </div>
             
             
            
            
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
            <button type="submit" class="btn btn-info">Save</button>
            <a href="{{ route('permission.permission_management') }}"><button type="button" class="btn btn-default float-right">Cancel</button><a>
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
  $("#permission_create").validate({
    rules: {
        name: {
            required: true,
        },
        slug: {
            required: true,
        },
       
    },
    // Specify validation error messages
    messages: {
        name: {
            required: "Please provide a name",
        },
        slug: {
            required: "Please provide a slug",
        }, 
        
    },
   
    submitHandler: function(form) {
      form.submit();
    }
  });
});
 

    </script>
@stop